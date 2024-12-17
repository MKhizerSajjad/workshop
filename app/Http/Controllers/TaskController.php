<?php

namespace App\Http\Controllers;

// use Auth;
use App\Models\TaskItemProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Part;
use App\Models\Task;
use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use App\Models\Priority;
use App\Models\Customer;
use App\Models\PickupPoint;
use App\Models\TaskMedia;
use App\Models\TaskService;
use App\Models\TaskProduct;
use App\Models\TaskPayment;
use App\Models\SerivceLocation;
use App\Models\Setting;
use App\Models\TaskComment;
use App\Models\TaskLeavePart;
use Symfony\Component\VarDumper\VarDumper;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $data = Task::with('technician')->orderByDesc('code')->paginate(10);

        return view('case.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create0()
    {
        return view('case.create_backup');
    }

    public function create()
    {
        $data = json_decode('{}');
        $data->items = Item::where('status', 1)->orderBy('name')->get();
        $data->parts = Part::where('status', 1)->orderBy('name')->get();
        $data->services = Service::orderBy('name')->get(); // where('status', '!=', 3)->
        $data->priorities = Priority::where('status', 1)->orderBy('id')->get();
        $data->serviceLocations = SerivceLocation::where('status', 1)->orderBy('id')->get();
        $data->terms = Setting::where('type', 'term')->pluck('data')->first() ?? null;

        if(auth()->check() && Auth::user()->user_type != 4) {
            $data->products = Product::where('status', 1)->orderBy('name')->get();
            $data->case_number = $this->generateInvoiceCode();
            $data->tax = getTax();
            return view('case.add', compact('data'));
        } else {
            return view('case.create', compact('data'));
        }
    }

    public function store(Request $request)
    {
        $serviceLocationID = $request->input('services_location');
        $serviceLocationFields = SerivceLocation::where('id', $serviceLocationID)->value('fields');
        $fieldsArray = json_decode($serviceLocationFields);

        $additionalRules = [
            'item' => 'required',
            'manufacturer' => 'required',
            'model' => 'required',
            'year' => 'required',
            'color' => 'required',
            'additional_info' => 'nullable',
            'problem_description' => 'nullable',
            // 'description' => 'required',
            'priority' => 'required',
            'service.*' => 'required',
            'parts.*' => 'required',
            'files.*' => 'nullable|file|mimes:jpeg,png,pdf,docx|max:10240000',
        ];

        // Merge dynamic field validation with additional rules
        $rules = [];
        foreach ($fieldsArray as $field) {
            $fieldName = $serviceLocationID . '-' . $field->name;
            $isMandatory = $field->is_mandatory == 1 ? 'required' : 'nullable';
            $rules[$fieldName] = $isMandatory;
        }
        $rules = array_merge($additionalRules, $rules);

        // Validate the request with merged rules
        $this->validate($request, $rules);

        $phone = $request->input($serviceLocationID.'-'.'phone');
        $customer = [];
        foreach ($fieldsArray as $field) {
            $customer[$field->name] = $request->input($serviceLocationID.'-'.$field->name) ?? '';
        }

        $customerAdd = Customer::updateOrCreate(
            ['phone' => $phone], //
            $customer
        );

        $terms = [];
        if ($request->has('terms')) {
            foreach ($request->input('terms') as $key => $termData) {
                $terms[] = [
                    'title' => str_replace('_', ' ', $key),
                    'name' => $key,
                    'link' => $termData['link'] ?? null,
                    'is_check' => $termData['status'] ?? '0'
                ];
            }
        }
        $confirmation = json_encode($terms);

        $invoce = $request->input('case_number') ??$this->generateInvoiceCode();
        $data = [
            'code' => $invoce,
            'date_opened' => now(),
            'customer_id' => $customerAdd->id ?? null,
            'user_id' => auth()->check() ? auth()->id() : null,
            'details' => $confirmation,
            'item_id' => $request->input('item'),
            'manufacturer' => $request->input('manufacturer'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'color' => $request->input('color'),
            'additional_info' => $request->input('additional_info'),
            'problem_description' => $request->input('problem_description'),
            'priority_id' => $request->input('priority'),
            'inspection_diagnose' => $request->input('inspection'),
            'services_location' => $request->input('services_location'),
            'service_desired_total' => $request->input('service_desired_total') ?? null,
        ];

        $task = Task::create($data);
        $isCustomerChoice = (!auth()->check() || Auth::user()->user_type == 4) ? 1 : 2;

        $taskId = $task->id;
        $taxPercentage = getTax();

        // Merge Product Scenario
        $row_count = $request->input("row_count");
        $product = [];
        $totalProductAmount = 0;
        for ($count=1; $count <= $row_count; $count++) {
            if (($request->input("merge_name_$count") == null) && count($request->input("product_$count")) == 1) {
                $mergeProduct = $request->input("name_$count")[0];
            } else {
                $mergeProduct = $request->input("merge_name_$count");
            }
            if(($mergeProduct == null || $mergeProduct == '') && count($request->input("product_$count")) == 0) {
                continue;
            }
            $productArray = $request->input("product_$count");
            $priceArray = $request->input("price_$count");
            $qtyArray = $request->input("qty_$count");
            $taxArray = $request->input("tax_$count");
            $totalItemsAmount = 0;
            $totalItemsAmountExTax = 0;
            foreach((array)$productArray as $key => $value) {
                if($value == null || $value == ''){
                    continue;
                }

                $productTaxAmount = $taxArray[$key] * $priceArray[$key] / 100;
                $productWithTax = $priceArray[$key] + $productTaxAmount;
                $totalItemPrice = $productWithTax * $qtyArray[$key];
                $totalItemsAmount += $totalItemPrice;
                $totalItemsAmountExTax += $priceArray[$key] * $qtyArray[$key];

                $product[$mergeProduct]['child'][] = [
                    'id' => $value,
                    'qty' => $qtyArray[$key],
                    'price' => $priceArray[$key],
                    'total' =>  $totalItemPrice,
                    'tax' =>  $taxArray[$key] ?? 0
                ];
            }
            $product[$mergeProduct]['name'] = $mergeProduct;
            $product[$mergeProduct]['qty'] = 1;
            $product[$mergeProduct]['total'] = $totalItemsAmountExTax;
            $totalProductAmount += $totalItemsAmount;
        }

        // Parent Product
        TaskItemProduct::where('task_id', $taskId)->delete();
        TaskProduct::where('task_id', $taskId)->delete();
        foreach ($product as $key => $productData) {
            $data = [
                'task_id' => $taskId,
                'name' => $productData['name'],
                'total' => $productData['total'],
            ];
            $parentProduct = TaskProduct::updateOrCreate(
                [
                    'task_id' => $taskId,
                    'name' => $productData['name']
                ],
                $data
            );

            // Child if available
            if (isset($productData['child'])) {
                foreach ($productData['child'] as $childData) {
                    $productInfo = Product::whereId($childData['id'])->first();
                    if(!isset($productInfo->id)){
                        continue;
                    }
                    $data = [
                        'product_id' => $childData['id'],
                        'qty' => $childData['qty'],
                        'unit_price' => $childData['price'],
                        'total' => $childData['total'],
                        'tax_perc' => $childData['tax'],
                    ];

                    TaskItemProduct::updateOrCreate(
                        [
                            'task_id' => $taskId,
                            'product_id' => $childData['id'],
                            'task_products_id' => $parentProduct->id
                        ],
                        $data
                    );
                }
            }
        }

        // File Upload
        if ($request->hasFile('files')) {

            $index = 0; // Initialize the index variable
            foreach ($request->file('files') as $file) {
                try {

                    // $path = $file->store('task/images', 'public'); // 'images' is a folder inside 'public' disk
                    // $url = asset('storage/' . $path);

                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = time() . '_' . $index . '_' . $task->id . '.' . $extension;

                    $file->move(public_path('task/media/'), $fileNameToStore);
                    // $file->move(base_path('/public/task/media/'), $fileNameToStore);
                    // $path = $file->store('task/media', $fileNameToStore); // 'images' is a folder inside 'public' disk
                    // $url = asset('storage/' . $path);
                    // $file->storeAs('public/media', $fileNameToStore);

                    $data = [
                        'task_id' => $task->id,
                        'type' => getFileTypeFromExtension($extension),
                        'media' => $fileNameToStore,
                        'customer_choice' => $isCustomerChoice,
                        'leave_receive' => 1
                    ];
                    $media = TaskMedia::create($data);

                    // logger('File saved successfully: ' . $fileNameToStore);
                    $index++;

                } catch (\Exception $e) {
                    logger('Error saving file: ' . $e->getMessage());

                }
            }
        }

        // Services
        $services_row_count = $request->input("services_row_count");
        $product = [];
        $totalServiceAmount = 0;
        for ($count=1; $count <= $services_row_count; $count++) {

            $servicePrice = $request->input("service_price_$count") * $request->input("service_qty_$count");
            $serviceTaxAmount = $request->input("service_tax_$count") * $servicePrice / 100;
            $serviceWithTax = $servicePrice + $serviceTaxAmount;
            $totalServiceAmount += $servicePrice;

            TaskService::create([
                'task_id' => $taskId,
                'service_id' => $request->input("service_$count"),
                'customer_choice' => $isCustomerChoice,
                'qty' => $request->input("service_qty_$count"),
                'unit_price' => $request->input("service_price_$count"),
                'tax_perc' => $request->input("service_tax_$count") ?? 0,
            ]);
        }

        // if(isset($request->services)) {
        //     foreach ($request->input('services') as $key => $service_id) {

        //         $dbService = Service::where('id', $service_id)->select('id', 'price', 'tax')->first();

        //         $qty = $service['qty'] ?? 1;
        //         $price = $dbService->price ?? null;
        //         $tax = ($dbService->add_tax == 1 ? getTax() : 0) ?? null;
        //         $serviceTaxAmount = $tax * $price / 100;
        //         $serviceWithTax = $price + $serviceTaxAmount;
        //         $servicePrice = $serviceWithTax * $qty;
        //         $totalServiceAmount += $servicePrice;

        //         TaskService::create([
        //             'task_id' => $task->id,
        //             'service_id' => $service_id,
        //             'customer_choice' => $isCustomerChoice,
        //             'qty' => $qty,
        //             'unit_price' => $price,
        //             'tax_perc' => $tax,
        //         ]);
        //     }
        // }

        $totalAmount = 0;
        $totalAmount = $totalServiceAmount + $totalProductAmount;

        $task->update(['total' => $totalAmount, 'pending' => $totalAmount]);
        // Get extra-parts from request and process them
        $extraParts = $request->input('extra-parts', '');
        $extraPartsArray = array_map('trim', explode(',', $extraParts));
        $extraPartsArray = array_filter($extraPartsArray); // Remove empty values
        $parts = [];

        foreach ($extraPartsArray as $field) {
            $added = Part::updateOrCreate(
                ['name' => $field],
                ['status' => 2],
            );

            $parts[] = $added->id;
        }

        if($request->input('parts')) {

            $mergedParts = array_merge($parts, $request->input('parts'));
            // logger('mergedParts : ' . json_encode($mergedParts));
            $uniqueMergedParts = array_unique($mergedParts);

            // logger('uniqueMergedParts : ' . json_encode($uniqueMergedParts));

            if(isset($uniqueMergedParts)) {
                foreach ($uniqueMergedParts as $part_id) {
                    TaskLeavePart::create([
                        'task_id' => $task->id,
                        'part_id' => $part_id,
                    ]);
                }
            }
        }

        if(auth()->check() && Auth::user()->user_type != 4) {
            return redirect()->route('case.index')->with('success','Record created successfully');
        } else {
            return redirect()->route('bookingStatusSearch', ['case_number' => $invoce, 'phone' => $phone])->with('success','Your booking has been created successfully');
        }






        // ## General info
        // $job                      = new Job;
        // $job->date_opened         = Carbon::now();
        // $job->customer_id         = Auth::check() ? auth()->user()->id : null;
        // // $job->technician_id       = 0;//
        // // $job->company_id          = 0;//
        // $job->details             = 0;//
        // $job->item_id             = $request->item;
        // $job->manufacturer        = $request->manufacturer;
        // $job->model               = $request->model;
        // $job->year                = $request->year;
        // $job->color               = $request->color;
        // $job->additional_info     = $request->additional_info;
        // $job->problem_description = $request->description;
        // $job->priority_id         = $request->priority;
        // $job->save();

        // ## Services
        // foreach($request->service as $service_id){
        //     $job_service = new JobService;
        //     $job_service->job_id     = $job->id;
        //     $job_service->service_id = $service_id;
        //     $job_service->save();
        // }

        // ## Parts
        // foreach($request->parts as $part_id){
        //     $job_part             = new JobLeavePart;
        //     $job_part->job_id     = $job->id;
        //     $job_part->part_id    = $part_id;
        //     $job_part->save();
        // }

        // ## Media
        // if ($request->hasFile('files')) {

        //     $index = 0; // Initialize the index variable
        //     foreach ($request->file('files') as $file) {
        //         try {
        //             $filenameWithExt = $file->getClientOriginalName();
        //             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //             $extension = $file->getClientOriginalExtension();
        //             $fileNameToStore = time() . '_' . $index . '.' . $extension;

        //             $file->storeAs('public/media', $fileNameToStore);

        //             $job_media = new JobMedia;
        //             $job_media->job_id = $job->id;
        //             $job_media->media = $fileNameToStore;
        //             $job_media->save();

        //             logger('File saved successfully: ' . $fileNameToStore);
        //             $index++;

        //         } catch (\Exception $e) {
        //             logger('Error saving file: ' . $e->getMessage());

        //         }
        //     }
        // } else {
        //     logger('No files found in the request.');
        // }

        // return 'DATA SAVED SUCCESSFULLY';
    }

    public function show(Task $task)
    {
        $data = $task;
        return view('case.show', compact('data'));
    }

    public function edit(Task $task)
    {
        $data = json_decode('{}');
        $data->task = Task::where('id', $task->id)->with('customer', 'media', 'taskServices', 'taskLeaveParts', 'taskProducts.taskItemProducts')->first();
        $data->confirmations = isset($task->details) ? json_decode($task->details, true) : null;
        $data->items = Item::where('status', 1)->orderBy('name')->get();
        $data->parts = Part::where('status', 1)->orderBy('name')->get();
        $data->services = Service::orderBy('name')->get(); // where('status', 1)->
        $data->priorities = Priority::where('status', 1)->orderBy('id')->get();
        $data->products = Product::where('status', 1)->orderBy('name')->get();
        $data->serviceLocations = SerivceLocation::where('status', 1)->orderBy('id')->get();
        $data->technicians = User::where([['status', 1],['user_type', 3]])->orderBy('first_name')->get();
        // $data->taskProduct = TaskProduct::with('taskChildProducts')->where('task_id', $task->id)->where('task_products_id', null)->get();

        return view('case.edit',compact('data'));
    }

    public function edit1(Task $task)
    {
        $data = json_decode('{}');
        $data->task = Task::where('id', $task->id)->with('customer', 'media', 'taskServices', 'taskLeaveParts', 'taskProducts.taskItemProducts', 'taskPayments')->first();
        $data->confirmations = isset($task->details) ? json_decode($task->details, true) : null;
        $data->items = Item::where('status', 1)->orderBy('name')->get();
        $data->parts = Part::where('status', 1)->orderBy('name')->get();
        $data->services = Service::orderBy('name')->get(); // where('status', 1)->
        $data->priorities = Priority::where('status', 1)->orderBy('id')->get();
        $data->products = Product::where('status', 1)->orderBy('name')->get();
        $data->serviceLocations = SerivceLocation::where('status', 1)->orderBy('id')->get();
        $data->technicians = User::where([['status', 1],['user_type', 3]])->orderBy('first_name')->get();
        $data->tax = getTax();

        // dd($data->task);
        // $data->taskProduct = TaskProduct::with('taskChildProducts')->where('task_id', $task->id)->where('task_products_id', null)->get();

        return view('case.new-edit1',compact('data'));
    }

    public function update(Request $request, Task $task)
    {

        $additionalRules = [
            // 'item' => 'required',
            // 'manufacturer' => 'required',
            // 'model' => 'required',
            // 'year' => 'required',
            // 'color' => 'required',
            'additional_info' => 'nullable',
            'problem_description' => 'nullable',
            // 'description' => 'required',
            'priority' => 'required',
            'service.*' => 'required',
            'parts.*' => 'required',
            'files.*' => 'required|file|mimes:jpeg,png,pdf,docx|max:10240000',
            // 'status' => 'required',
            // 'payment_status' => 'required',
        ];

        $rules = $additionalRules;
        $serviceLocationID = $request->input('services_location');
        if($serviceLocationID) {
            $serviceLocationFields = SerivceLocation::where('id', $serviceLocationID)->value('fields');
            $fieldsArray = json_decode($serviceLocationFields);

            // Merge dynamic field validation with additional rules
            $rules = [];
            foreach ($fieldsArray as $field) {
                $fieldName = $serviceLocationID . '-' . $field->name;
                $isMandatory = $field->is_mandatory == 1 ? 'required' : 'nullable';
                $rules[$fieldName] = $isMandatory;
            }
            $rules = array_merge($additionalRules, $rules);
        }

        // Validate the request with merged rules
        $this->validate($request, $rules);

        if($serviceLocationID && isset($serviceLocationID)) {
            $phone = $request->input($serviceLocationID.'-phone');
            $customer = [];
            foreach ($fieldsArray as $field) {
                if($field->name == 'phone') {
                    // continue;
                }
                $customer[$field->name] = $request->input($serviceLocationID.'-'.$field->name) ?? '';
            }
            $customerAdd = Customer::updateOrCreate(
                ['phone' => $phone],
                $customer
            );
        }

        // Terms & Condition / Confirmations
        $terms = [];
        if ($request->has('terms')) {
            foreach ($request->input('terms') as $key => $termData) {
                $terms[] = [
                    'title' => str_replace('_', ' ', $key),
                    'name' => $key,
                    'link' => $termData['link'] ?? null,
                    'is_check' => $termData['status'] ?? '0'
                ];
            }
        }
        $confirmation = json_encode($terms);

        $data = [
            // 'status' => $request->input('status'),
            // 'payment_status' => $request->input('payment_status'),

            'date_opened' => $request->input('date_opened'),
            'date_closed' => $request->input('date_closed'),
            'date_service' => $request->input('date_service'),
            'customer_id' => $customerAdd->id ?? $task->customer_id,
            'details' => $confirmation,
            'item_id' => $request->input('item') ?? $task->item_id,
            'technician_id' => $request->input('technician_id'),
            'manufacturer' => $request->input('manufacturer') ?? $task->manufacturer,
            'model' => $request->input('model') ?? $task->model,
            'year' => $request->input('year') ?? $task->year,
            'color' => $request->input('color') ?? $task->color,
            'additional_info' => $request->input('additional_info') ?? $task->additional_info,
            'problem_description' => $request->input('problem_description') ?? $task->problem_description,
            'priority_id' => $request->input('priority') ?? $task->priority,
            'inspection_diagnose' => $request->input('inspection') ?? $task->inspection,
            'services_location' => $request->input('services_location') ?? $task->services_location,
            'service_desired_total' => $request->input('service_desired_total') ?? $task->service_desired_total,
        ];

        $taskId = $task->id;
        $task = Task::updateOrCreate(['id' => $taskId], $data);

        $taxPercentage = getTax();

        // Merge Product Scenario
        $row_count = $request->input("row_count");
        $product = [];
        $totalProductAmount = 0;
        for ($count=1; $count <= $row_count; $count++) {
            if (($request->input("merge_name_$count") == null) && count($request->input("product_$count")) == 1) {
                $mergeProduct = $request->input("name_$count")[0];
            } else {
                $mergeProduct = $request->input("merge_name_$count");
            }
            if(($mergeProduct == null || $mergeProduct == '') && count($request->input("product_$count")) == 0) {
                continue;
            }
            $productArray = $request->input("product_$count");
            $priceArray = $request->input("price_$count");
            $qtyArray = $request->input("qty_$count");
            $taxArray = $request->input("tax_$count");
            $totalItemsAmount = 0;
            $totalItemsAmountExTax = 0;
            foreach((array)$productArray as $key => $value) {
                if($value == null || $value == ''){
                    continue;
                }

                $productTaxAmount = $qtyArray[$key] * $priceArray[$key] / 100;
                $productWithTax = $priceArray[$key] + $productTaxAmount;
                $totalItemPrice = $productWithTax * $qtyArray[$key];
                $totalItemsAmount += $totalItemPrice;
                $totalItemsAmountExTax += $priceArray[$key] * $qtyArray[$key];

                $product[$mergeProduct]['child'][] = [
                    'id' => $value,
                    'qty' => $qtyArray[$key],
                    'price' => $priceArray[$key],
                    'total' =>  $totalItemPrice,
                    'tax' =>  $taxArray[$key]
                ];
            }
            $product[$mergeProduct]['name'] = $mergeProduct;
            $product[$mergeProduct]['qty'] = 1;
            $product[$mergeProduct]['total'] = $totalItemsAmountExTax;
            $totalProductAmount += $totalItemsAmount;
        }

        // Parent Product
        TaskItemProduct::where('task_id', $taskId)->delete();
        TaskProduct::where('task_id', $taskId)->delete();
        foreach ($product as $key => $productData) {
            $data = [
                'task_id' => $taskId,
                'name' => $productData['name'],
                'total' => $productData['total'],
            ];
            $parentProduct = TaskProduct::updateOrCreate(
                [
                    'task_id' => $taskId,
                    'name' => $productData['name']
                ],
                $data
            );

            // Child if available
            if (isset($productData['child'])) {
                foreach ($productData['child'] as $childData) {
                    $productInfo = Product::whereId($childData['id'])->first();
                    if(!isset($productInfo->id)){
                        continue;
                    }
                    $data = [
                        'product_id' => $childData['id'],
                        'qty' => $childData['qty'],
                        'unit_price' => $childData['price'],
                        'total' => $childData['total'],
                        'tax_perc' => $childData['tax'],
                    ];

                    TaskItemProduct::updateOrCreate(
                        [
                            'task_id' => $taskId,
                            'product_id' => $childData['id'],
                            'task_products_id' => $parentProduct->id
                        ],
                        $data
                    );
                }
            }
        }

        $isCustomerChoice = (!auth()->check() || Auth::user()->user_type == 4) ? 1 : 2;
        if ($request->hasFile('files')) {

            $index = 0; // Initialize the index variable
            foreach ($request->file('files') as $file) {
                try {

                    // $path = $file->store('task/images', 'public'); // 'images' is a folder inside 'public' disk
                    // $url = asset('storage/' . $path);

                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = time() . '_' . $index . '_' . $task->id . '.' . $extension;

                    $file->move(public_path('task/media/'), $fileNameToStore);
                    // $file->move(base_path('/public/task/media/'), $fileNameToStore);
                    // $path = $file->store('task/media', $fileNameToStore); // 'images' is a folder inside 'public' disk
                    // $url = asset('storage/' . $path);
                    // $file->storeAs('public/media', $fileNameToStore);

                    $data = [
                        'task_id' => $task->id,
                        'type' => getFileTypeFromExtension($extension),
                        'media' => $fileNameToStore,
                        'customer_choice' => $isCustomerChoice,
                        'leave_receive' => 1,
                    ];
                    $media = TaskMedia::create($data);
                    // logger('File saved successfully: ' . $fileNameToStore);
                    $index++;

                } catch (\Exception $e) {
                    logger('Error saving file: ' . $e->getMessage());

                }
            }
        }


        // Services
        $services_row_count = $request->input("services_row_count");
        $product = [];
        $totalServiceAmount = 0;
        for ($count=1; $count <= $services_row_count; $count++) {

            $servicePrice = $request->input("service_price_$count") * $request->input("service_qty_$count");
            $serviceTaxAmount = $request->input("service_tax_$count") * $servicePrice / 100;
            $serviceWithTax = $servicePrice + $serviceTaxAmount;
            $totalServiceAmount += $servicePrice;

            TaskService::updateOrCreate(
                [
                    'task_id' => $taskId,
                    'service_id' => $request->input("service_$count"),
                ], [
                    'customer_choice' => $isCustomerChoice,
                    'qty' => $request->input("service_qty_$count"),
                    'unit_price' => $request->input("service_price_$count"),
                    'tax_perc' => $request->input("service_tax_$count"),
                ]
            );
        }


        // Services
        // $totalServiceAmount = 0;
        // if ($request->input('services')) {
        //     foreach ($request->input('services') as $service) {
        //         $dbService = Service::where('id', $service)->select('id', 'price', 'tax')->first();

        //         $qty = $service['qty'] ?? 1;
        //         $price = $dbService->price ?? null;
        //         $tax = ($dbService->add_tax == 1 ? getTax() : 0) ?? null;
        //         $serviceTaxAmount = $tax * $price / 100;
        //         $serviceWithTax = $price + $serviceTaxAmount;
        //         $servicePrice = $serviceWithTax * $qty;
        //         $totalServiceAmount += $servicePrice;
        //         $data = [
        //             'service_id' => $service,
        //             'qty' => $qty,
        //             'unit_price' => $price,
        //             'tax_perc' => $tax
        //         ];

        //         TaskService::updateOrCreate(
        //             [
        //                 'task_id' => $taskId,
        //                 'service_id' => $service,
        //             ],
        //             $data
        //         );
        //     }
        // }

        $totalAmount = 0;
        $totalAmount = $totalServiceAmount + $totalProductAmount;
        $pending = $totalAmount - $task->paid;

        $task->update(['total' => $totalAmount, 'pending' => $pending]);

        $task->leaveParts()->sync($request->input('parts', []));
        // $task->services()->sync($request->input('services', []));
        // $task->products()->sync($request->input('products', []));

        // if(isset($request->services)) {
        //     foreach ($request->input('services') as $service_id) {
        //         TaskService::create([
        //             'task_id' => $task->id,
        //             'service_id' => $service_id,
        //         ]);
        //     }
        // }

        // if(isset($request->parts)) {
        //     foreach ($request->input('parts') as $part_id) {
        //         TaskLeavePart::create([
        //             'task_id' => $task->id,
        //             'part_id' => $part_id,
        //         ]);
        //     }
        // }

        return redirect()->route('case.edit1', $task->id)->with('success','Record update successfully');
    }

    public function statusUpdate(Request $request, Task $task)
    {
        $this->validate($request, [
            'payment_method' => 'required',
            'amount' => 'required|numeric|gt:0|max:' . $task->pending,
        ]);

        $taskId = $task->id;
        $data = [
            'task_id' => $taskId,
            'via' => $request->input('payment_method'),
            'amount' => $request->input('amount'),
            'note' => $request->input('note') ?? null,
            'user_id' => Auth::user()->id
        ];
        TaskPayment::create($data);

        $amount = $request->input('amount');

        if ($amount > 0) {
            $pending = $task->pending - $amount;
            $paid = $task->paid + $amount;
            $payment_status = (((int)$paid == (int)$task->total) && ((int)$pending == 0)) ? 1 : 2;
        } else {
            $pending = $task->pending;
            $paid = $task->paid;
            $payment_status = $task->status;
        }

        Task::where('id', $taskId)->update([
            'payment_status' => $payment_status,
            'pending' => $pending,
            'paid' => $paid
        ]);

        return redirect()->route('case.edit1', $taskId)->with('success','Payment added successfully');
    }

    public function itemInfoUpdate(Request $request, Task $task)
    {

        $rules = [
            'item' => 'required',
            'manufacturer' => 'required',
            'model' => 'required',
            'year' => 'required',
            'color' => 'required',
            'additional_info' => 'nullable',
            'problem_description' => 'nullable',
        ];

        // Validate the request with merged rules
        $this->validate($request, $rules);

        $data = [
            'item_id' => $request->input('item') ?? $task->item_id,
            'manufacturer' => $request->input('manufacturer') ?? $task->manufacturer,
            'model' => $request->input('model') ?? $task->model,
            'year' => $request->input('year') ?? $task->year,
            'color' => $request->input('color') ?? $task->color,
            'additional_info' => $request->input('additional_info') ?? $task->additional_info,
            'problem_description' => $request->input('problem_description') ?? $task->problem_description,
        ];

        $taskId = $task->id;
        $task = Task::updateOrCreate(['id' => $taskId], $data);

        return redirect()->route('case.edit1', $task->id)->with('success','Record update successfully');
    }

    public function customerInfoUpdate(Request $request, Task $task)
    {
        $additionalRules = [];
        $rules = $additionalRules;
        $serviceLocationID = $request->input('services_location');
        if($serviceLocationID) {
            $serviceLocationFields = SerivceLocation::where('id', $serviceLocationID)->value('fields');
            $fieldsArray = json_decode($serviceLocationFields);

            // Merge dynamic field validation with additional rules
            $rules = [];
            foreach ($fieldsArray as $field) {
                $fieldName = $serviceLocationID . '-' . $field->name;
                $isMandatory = $field->is_mandatory == 1 ? 'required' : 'nullable';
                $rules[$fieldName] = $isMandatory;
            }
            $rules = array_merge($additionalRules, $rules);
        }

        // Validate the request with merged rules
        $this->validate($request, $rules);

        if($serviceLocationID && isset($serviceLocationID)) {
            $phone = $request->input($serviceLocationID.'-phone');
            $customer = [];
            foreach ($fieldsArray as $field) {
                if($field->name == 'phone') {
                    // continue;
                }
                $customer[$field->name] = $request->input($serviceLocationID.'-'.$field->name) ?? '';
            }
            $customerAdd = Customer::updateOrCreate(
                ['phone' => $phone],
                $customer
            );
        }

        $data = [
            'customer_id' => $customerAdd->id ?? $task->customer_id,
        ];

        $taskId = $task->id;
        $task = Task::updateOrCreate(['id' => $taskId], $data);

        return redirect()->route('case.edit1', $task->id)->with('success','Record update successfully');
    }

    public function comment(Request $request, Task $task)
    {
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $taskId = $task->id;
        $data = [
            'task_id' => $taskId,
            'type' => $request->input('visibility') ?? 1,
            'comment' => $request->input('comment'),
            'user_id' => Auth::user()->id
        ];
        TaskComment::create($data);

        return redirect()->route('case.edit1', $taskId)->with('success','Comment added successfully');
    }

    public function commentUpdate(Request $request, $taskId, $commentId)
    {
        $this->validate($request, [
            'comment' => 'required|string|max:500'
        ]);

        $data = [
            'type' => $request->input('visibility') ?? 1,
            'comment' => $request->input('comment'),
            'user_id' => Auth::user()->id
        ];

        $comment = TaskComment::find($commentId);
        if ($comment) {
            $comment->update($data);
        } else {
            return redirect()->route('case.edit1', $taskId)->with('error', 'Comment not found');
        }

        return redirect()->route('case.edit1', $taskId)->with('success', 'Comment updated successfully');
    }

    public function commentDelete(Request $request, $taskId, $commentId)
    {
        $comment = TaskComment::find($commentId);
        if ($comment) {
            $comment->delete();
        } else {
            return redirect()->route('case.edit1', $taskId)->with('error', 'Comment not found');
        }

        return redirect()->route('case.edit1', $taskId)->with('success', 'Comment deleted successfully.');
    }

    public function destroy(Task $task)
    {
        //
    }

    public function destroyMedia(Request $request, $id=0)
    {
        TaskMedia::where('id', $id)->delete();
        return response()->json(['message' => $id]);

        // $task->media()->delete();
    }

    public function invoice(Task $task)
    {
        return view('case.invoice', compact('task'));
    }

    public function status()
    {
        return view('case.status');
    }

    public function statusSearch(Request $request)
    {
        $request->validate([
            'case_number' => 'required|string',
            'phone' => 'required|string',
        ]);

        $caseNumber = $request->input('case_number');
        $phone = $request->input('phone');

        $task = Task::where('code', $caseNumber)->with('customer', 'media', 'taskServices', 'taskLeaveParts', 'taskProducts')
                    ->whereHas('customer', function ($query) use ($phone) {
                        $query->where('phone', $phone);
                    })->first();

        $data = $task;
        if(isset($task)) {
            $data = json_decode('{}');
            $data->task = $task;
            $data->confirmations = isset($task->details) ? json_decode($task->details, true) : null;
            $data->items = Item::where('status', 1)->orderBy('name')->get();
            $data->parts = Part::where('status', 1)->orderBy('name')->get();
            $data->services = Service::orderBy('name')->get(); // where('status', 1)->
            $data->priorities = Priority::where('status', 1)->orderBy('id')->get();
            $data->products = Product::where('status', 1)->orderBy('name')->get();
            $data->serviceLocations = SerivceLocation::where('status', 1)->orderBy('id')->get();
            $data->technicians = User::where([['status', 1],['user_type', 3]])->orderBy('first_name')->get();
        }

        return view('case.status',compact('data'));
    }

    public function takeBack()
    {
        return view('case.take_back');
    }

    public function takeBackDetails(Request $request)
    {
        $request->validate([
            'case_number' => 'required|string',
            'phone' => 'required|string',
        ]);

        $caseNumber = $request->input('case_number');
        $phone = $request->input('phone');

        $task = Task::where('code', $caseNumber)->with('customer', 'media', 'taskServices', 'taskLeaveParts', 'taskProducts')
                    ->whereHas('customer', function ($query) use ($phone) {
                        $query->where('phone', $phone);
                    })->first();

        $data = $task;
        if(isset($task)) {
            $data = json_decode('{}');
            $data->task = $task;
            $data->confirmations = isset($task->details) ? json_decode($task->details, true) : null;
            $data->items = Item::where('status', 1)->orderBy('name')->get();
            $data->parts = Part::where('status', 1)->orderBy('name')->get();
            $data->services = Service::orderBy('name')->get(); // where('status', 1)->
            $data->priorities = Priority::where('status', 1)->orderBy('id')->get();
            $data->products = Product::where('status', 1)->orderBy('name')->get();
            $data->serviceLocations = SerivceLocation::where('status', 1)->orderBy('id')->get();
            $data->technicians = User::where([['status', 1],['user_type', 3]])->orderBy('first_name')->get();
            $data->pickupPoints = PickupPoint::where('status', 1)->get();
        }

        return view('case.take_back',compact('data'));
    }

    public function saveTakeBack(Request $request, Task $task)
    {
        $data = [
            'pickup_point_id' => $request->input('pickup_ponint_id'),
            'is_servised' => $request->input('is_servised'),
            'is_satisfied' => $request->input('is_satisfied'),
        ];

        $taskId = $task->id;
        $task = Task::updateOrCreate(['id' => $taskId], $data);

        $isCustomerChoice = (!auth()->check() || Auth::user()->user_type == 4) ? 1 : 2;
        if ($request->hasFile('files')) {

            $index = 0; // Initialize the index variable
            foreach ($request->file('files') as $file) {
                try {

                    // $path = $file->store('task/images', 'public'); // 'images' is a folder inside 'public' disk
                    // $url = asset('storage/' . $path);

                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = time() . '_' . $index . '_' . $task->id . '.' . $extension;
                    $file->move(base_path('/public/task/media/'), $fileNameToStore);
                    // $path = $file->store('task/media', $fileNameToStore); // 'images' is a folder inside 'public' disk
                    // $url = asset('storage/' . $path);
                    // $file->storeAs('public/media', $fileNameToStore);

                    $data = [
                        'task_id' => $task->id,
                        'type' => getFileTypeFromExtension($extension),
                        'media' => $fileNameToStore,
                        'customer_choice' => $isCustomerChoice,
                        'leave_receive' => 2,
                    ];
                    $media = TaskMedia::create($data);

                    // logger('File saved successfully: ' . $fileNameToStore);
                    $index++;

                } catch (\Exception $e) {
                    logger('Error saving file: ' . $e->getMessage());

                }
            }
        }
    }

    public function generateInvoiceCode() {
        $currentYear = Carbon::now()->format('Y');
        $code = intval(substr($currentYear, 2, 4));
        $todaysCount = Task::where('code', 'LIKE', $code.'%')->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
    }
}
