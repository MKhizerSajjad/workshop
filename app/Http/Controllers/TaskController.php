<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Part;
use App\Models\Task;
use App\Models\Service;
use App\Models\Priority;
use App\Models\TaskMedia;
use App\Models\TaskService;
use App\Models\TaskLeavePart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        //
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
        $data->services = Service::where('status', 1)->orderBy('name')->get();
        $data->priorities = Priority::where('status', 1)->orderBy('id')->get();
        return view('case.create', compact('data'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
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
        ]);

        $invoce = $this->generateInvoiceCode();
        $data = [
            'code' => $invoce,
            'date_opened' => now(),
            'customer_id' => auth()->check() ? auth()->id() : null,
            'details' => 0, // Assuming this is correct based on your original code
            'item_id' => $request->input('item'),
            'manufacturer' => $request->input('manufacturer'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'color' => $request->input('color'),
            'additional_info' => $request->input('additional_info'),
            'problem_description' => $request->input('description'),
            'priority_id' => $request->input('priority'),
        ];

        $task = Task::create($data);

        if(isset($request->services)) {
            foreach ($request->input('services') as $service_id) {
                TaskService::create([
                    'task_id' => $task->id,
                    'service_id' => $service_id,
                ]);
            }
        }

        if(isset($request->parts)) {
            foreach ($request->input('parts') as $part_id) {
                taskLeavePart::create([
                    'task_id' => $task->id,
                    'part_id' => $part_id,
                ]);
            }
        }

        return redirect()->route('item.index')->with('success','Record created successfully');






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
        //
    }

    public function edit(Task $task)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        //
    }

    public function destroy(Task $task)
    {
        //
    }

    public function generateInvoiceCode() {
        $code = Carbon::now()->format('Ymd');
        $todaysCount = Task::where('code', 'LIKE', $code.'%')->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
    }
}
