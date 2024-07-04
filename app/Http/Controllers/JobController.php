<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobService;
use App\Models\JobMedia;
use App\Models\JobLeavePart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('case.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
  
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

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
