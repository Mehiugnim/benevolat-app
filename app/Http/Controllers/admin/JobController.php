<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::orderBy('created_at','DESC')->with('user','applications')->paginate(10);
        return view('admin.jobs.list',[
            'jobs' => $jobs
        ]);
    }

    public function edit($id) {
        $job = Job::findOrFail($id);

        $categories = Category::orderBy('name','ASC')->get();
        $jobTypes = JobType::orderBy('name','ASC')->get();
        
        return view('admin.jobs.edit',[
            'job' => $job,
            'categories' => $categories,
            'jobTypes' => $jobTypes,
        ]);
    }

    public function update(Request $request, $id) {

        $rules = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'description' => 'required',
            'location' => 'required|max:50',
            'company_name' => 'required|min:3|max:75',          

        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {

            $job = Job::find($id);
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id  = $request->jobType;
            $job->description = $request->description;
            $job->location = $request->location;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->nbr_volunteer = $request->nbr_volunteer;
            $job->state = $request->state;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->website;

            $job->status = $request->status;
            $job->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;
            $job->save();

            session()->flash('success','Job updated successfully.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request) {
        $id = $request->id;

        $job = Job::find($id);

        if ($job == null) {
            session()->flash('error','Either job deleted or not found');
            return response()->json([
                'status' => false                
            ]);
        }

        $job->delete();
        session()->flash('success','Job deleted successfully.');
        return response()->json([
            'status' => true                
        ]);
    }
}
