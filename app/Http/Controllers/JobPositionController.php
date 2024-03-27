<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosition;
use App\Http\Resources\JobResource;
use App\Http\Requests\JobRequest;
class JobPositionController extends Controller
{
    public function getJobs(){
        $jobs = JobPosition::latest()->get();
        $response=JobResource::collection($jobs);
          
          return response($response,200);
    }

    public function addJob(JobRequest $request){
        $jobs = JobPosition::create([
            'job_title' => $request->job_title,
            'description' => $request->description,
            'location' => $request->location,
            'user_id' => $request->user_id
            ]);
    
            $response=[
                'message'=>'Job Created',
                'jobs'=>$jobs,
            ];
            return response($response,200);
    }

        public function updateJob(JobRequest $request, $id){
        $job = JobPosition::find($id);
        $job->job_title = $request->job_title;
        $job->description = $request->description;
        $job->location =  $request->location;
        $job->user_id = $request->user_id;


        $job->save();
        if($job){
            $response =[
                'message'=> 'Rent job Updated',
                'jobs' => $job
            ];
        }else{
            $response =[
                'message'=> 'Error on Updateding',
            ];
        }
        
        return response($response, 200);


        }

    public function deleteJob($id){
        $job = JobPosition::find($id);
        if ($job) {
            $job->delete();
            $response = [
                'message' => 'Job deleted successfully!'
            ];
            return response($response, 200);
        } else {
            $response = [
                'message' => 'Job not found!'
            ];
            return response($response, 404);
        }
    }
}
