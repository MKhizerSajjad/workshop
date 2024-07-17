<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Part;
use App\Models\Job;
use App\Models\JobService;
use App\Models\JobMedia;
use App\Models\JobLeavePart;
use App\Models\Priority;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
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
            'name' => 'required|max:200',
            'colors' => ['required', 'array'],
            'colors.*' => ['required', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'],
            'manufacturer' => 'required|max:200',
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

        $job = Job::create($data);

        foreach ($request->input('service') as $service_id) {
            JobService::create([
                'job_id' => $job->id,
                'service_id' => $service_id,
            ]);
        }

        foreach ($request->input('parts') as $part_id) {
            JobLeavePart::create([
                'job_id' => $job->id,
                'part_id' => $part_id,
            ]);
        }






        ## General info
        $job                      = new Job;
        $job->date_opened         = Carbon::now();
        $job->customer_id         = Auth::check() ? auth()->user()->id : null;
        // $job->technician_id       = 0;//
        // $job->company_id          = 0;//
        $job->details             = 0;//
        $job->item_id             = $request->item;
        $job->manufacturer        = $request->manufacturer;
        $job->model               = $request->model;
        $job->year                = $request->year;
        $job->color               = $request->color;
        $job->additional_info     = $request->additional_info;
        $job->problem_description = $request->description;
        $job->priority_id         = $request->priority;
        $job->save();

        ## Services
        foreach($request->service as $service_id){
            $job_service = new JobService;
            $job_service->job_id     = $job->id;
            $job_service->service_id = $service_id;
            $job_service->save();
        }

        ## Parts
        foreach($request->parts as $part_id){
            $job_part             = new JobLeavePart;
            $job_part->job_id     = $job->id;
            $job_part->part_id    = $part_id;
            $job_part->save();
        }

        ## Media
        if ($request->hasFile('files')) {

            $index = 0; // Initialize the index variable
            foreach ($request->file('files') as $file) {
                try {
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = time() . '_' . $index . '.' . $extension;

                    $file->storeAs('public/media', $fileNameToStore);

                    $job_media = new JobMedia;
                    $job_media->job_id = $job->id;
                    $job_media->media = $fileNameToStore;
                    $job_media->save();

                    logger('File saved successfully: ' . $fileNameToStore);
                    $index++;

                } catch (\Exception $e) {
                    logger('Error saving file: ' . $e->getMessage());

                }
            }
        } else {
            logger('No files found in the request.');
        }

        return 'DATA SAVED SUCCESSFULLY';
    }

    public function show(Job $job)
    {
        //
    }

    public function edit(Job $job)
    {
        //
    }

    public function update(Request $request, Job $job)
    {
        //
    }

    public function destroy(Job $job)
    {
        //
    }

    public function generateInvoiceCode() {
        $code = Carbon::now()->format('Ymd');
        $todaysCount = Job::where('code', 'LIKE', $code.'%')->count();
        // Increment the max code number by 1, if null set it to 1
        return $code. str_pad(++$todaysCount, 5, '0', STR_PAD_LEFT);
    }
}
