<?php

namespace App\Http\Controllers;

// use Auth;
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
use App\Models\TaskMedia;
use App\Models\TaskService;
use App\Models\SerivceLocation;
use App\Models\TaskLeavePart;

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
        return view('case.create', compact('data'));
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
            // 'files.*' => 'required|file|mimes:jpeg,png,pdf,docx|max:2048',
        ];

        // Merge dynamic field validation with additional rules
        $rules = [];
        foreach ($fieldsArray as $field) {
            $fieldName = $serviceLocationID . '-' . $field->name;
            $rules[$fieldName] = 'required';
        }
        $rules = array_merge($additionalRules, $rules);

        // Validate the request with merged rules
        $this->validate($request, $rules);

        $phone = $request->input('phone');
        $customer = [];
        foreach ($fieldsArray as $field) {
            $customer[$field->name] = $request->input($serviceLocationID.'-'.$field->name) ?? '';
        }

        $customerAdd = Customer::updateOrCreate(
            ['phone' => $phone], //
            $customer
        );

        // Extract confirmation checkboxes
        $checkboxes = [
            'read_service_term' => isset($request['read_service_term']),
            'read_service_pricing' => isset($request['read_service_pricing']),
            'receive_newsletter' => isset($request['receive_newsletter']),
            'read_gdr' => isset($request['read_gdr']),
        ];
        // Convert to JSON array
        $confirmation = json_encode($checkboxes);

        $invoce = $this->generateInvoiceCode();
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
            'problem_description' => $request->input('description'),
            'priority_id' => $request->input('priority'),
            'inspection_diagnose' => $request->input('inspection'),
            'services_location' => $request->input('services_location'),
        ];

        $task = Task::create($data);

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
                    $path = $file->store('task/media', 'public'); // 'images' is a folder inside 'public' disk
                    // $url = asset('storage/' . $path);
                    // $file->storeAs('public/media', $fileNameToStore);

                    $data = [
                        'task_id' => $task->id,
                        'type' => getFileTypeFromExtension($extension),
                        'media' => $fileNameToStore,
                    ];
                    $media = TaskMedia::create($data);

                    logger('File saved successfully: ' . $fileNameToStore);
                    $index++;

                } catch (\Exception $e) {
                    logger('Error saving file: ' . $e->getMessage());

                }
            }
        }

        $isCustomerChoice = (!auth()->check() || Auth::user()->user_type == 4) ? 1 : 2;

        if(isset($request->services)) {
            foreach ($request->input('services') as $service_id) {
                TaskService::create([
                    'task_id' => $task->id,
                    'service_id' => $service_id,
                    'service_id' => $service_id,
                    'customer_choice' => $isCustomerChoice
                ]);
            }
        }

        if(isset($request->parts)) {
            foreach ($request->input('parts') as $part_id) {
                TaskLeavePart::create([
                    'task_id' => $task->id,
                    'part_id' => $part_id,
                ]);
            }
        }

        if(auth()->check() && Auth::user()->user_type != 4) {
            return redirect()->route('dashboard')->with('success','Record created successfully');
        } else {
            return redirect()->route('login')->with('success','Your booking has been created successfully');
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
        $data['task'] = $task;
        return view('case.show', compact('data'));
    }

    public function edit(Task $task)
    {
        $data = json_decode('{}');
        $data->task = Task::where('id', $task->id)->with('customer', 'media', 'taskServices', 'taskLeaveParts', 'taskProducts')->first();
        $data->confirmations = json_decode($task->details, true);
        $data->items = Item::where('status', 1)->orderBy('name')->get();
        $data->parts = Part::where('status', 1)->orderBy('name')->get();
        $data->services = Service::orderBy('name')->get(); // where('status', 1)->
        $data->priorities = Priority::where('status', 1)->orderBy('id')->get();
        $data->products = Product::where('status', 1)->orderBy('name')->get();
        $data->serviceLocations = SerivceLocation::where('status', 1)->orderBy('id')->get();
        $data->technicians = User::where([['status', 1],['user_type', 3]])->orderBy('first_name')->get();

        return view('case.edit',compact('data'));
    }

    public function update(Request $request, Task $task)
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
            // 'files.*' => 'required|file|mimes:jpeg,png,pdf,docx|max:2048',
        ];

        // Merge dynamic field validation with additional rules
        $rules = [];
        foreach ($fieldsArray as $field) {
            $fieldName = $serviceLocationID . '-' . $field->name;
            $rules[$fieldName] = 'required';
        }
        $rules = array_merge($additionalRules, $rules);

        // Validate the request with merged rules
        $this->validate($request, $rules);

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

        // Extract confirmation checkboxes
        $checkboxes = [
            'read_service_term' => isset($request['read_service_term']),
            'read_service_pricing' => isset($request['read_service_pricing']),
            'receive_newsletter' => isset($request['receive_newsletter']),
            'read_gdr' => isset($request['read_gdr']),
        ];
        // Convert to JSON array
        $confirmation = json_encode($checkboxes);

        $data = [
            'customer_id' => $customerAdd->id ?? null,
            'details' => $confirmation,
            'item_id' => $request->input('item'),
            'technician_id' => $request->input('technician_id'),
            'manufacturer' => $request->input('manufacturer'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'color' => $request->input('color'),
            'additional_info' => $request->input('additional_info'),
            'problem_description' => $request->input('description'),
            'priority_id' => $request->input('priority'),
            'inspection_diagnose' => $request->input('inspection'),
            'services_location' => $request->input('services_location'),
        ];

        $taskId = $task->id;
        $task = Task::updateOrCreate(['id' => $taskId], $data);

        // if ($request->hasFile('files')) {

        //     $index = 0; // Initialize the index variable
        //     foreach ($request->file('files') as $file) {
        //         try {

        //             // $path = $file->store('task/images', 'public'); // 'images' is a folder inside 'public' disk
        //             // $url = asset('storage/' . $path);

        //             $filenameWithExt = $file->getClientOriginalName();
        //             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //             $extension = $file->getClientOriginalExtension();
        //             $fileNameToStore = time() . '_' . $index . '_' . $task->id . '.' . $extension;
        //             $path = $file->store('task/media', 'public'); // 'images' is a folder inside 'public' disk
        //             // $url = asset('storage/' . $path);
        //             // $file->storeAs('public/media', $fileNameToStore);

        //             $data = [
        //                 'task_id' => $task->id,
        //                 'type' => getFileTypeFromExtension($extension),
        //                 'media' => $fileNameToStore,
        //             ];
        //             $media = TaskMedia::create($data);

        //             logger('File saved successfully: ' . $fileNameToStore);
        //             $index++;

        //         } catch (\Exception $e) {
        //             logger('Error saving file: ' . $e->getMessage());

        //         }
        //     }
        // }

        $task->services()->sync($request->input('services', []));
        $task->leaveParts()->sync($request->input('parts', []));
        $task->products()->sync($request->input('products', []));

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

        return redirect()->route('case.index')->with('success','Record update successfully');
    }

    public function destroy(Task $task)
    {
        //
    }

    public function invoice(Task $task)
    {
        return view('case.invoice', compact('task'));
    }

    public function generateInvoiceCode() {
        $code = Carbon::now()->format('Ymd');
        $todaysCount = Task::where('code', 'LIKE', $code.'%')->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
    }
}
