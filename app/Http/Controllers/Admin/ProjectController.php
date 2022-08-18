<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;
use Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Handle the project list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$projects = Project::get();
        $data = ['page_title'=>'Projects', 'projects'=>$projects];
        return view('admin.projects.list-projects', $data);
    }

    /**
     * Show the form for creating a new resource or to edit a existing resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id optional
     * @return \Illuminate\Http\Response
     */
    public function manage(Request $request, $id = '')
    {
        if($id > 0) {
            $result = Project::where(['id' => $id])->get();
            $data['project_name'] = $result['0']->project_name;
            $data['id'] = $result['0']->id;
            $data['page_title'] = 'Edit Project';
        }
        else {
            $data['project_name'] = '';
            $data['id'] = 0;
            $data['page_title'] = 'Add New Project';
        }
        return view('admin.projects.manage-project', $data);  
    }

    /**
     * Store a newly created resource in storage or Update existing resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        $data = $request->validate([
            'project_name' => 'required|unique:projects,project_name,'.$request->post('id'),
        ]);

        if($request->post('id') > 0) {
            $project = Project::find($request->post('id'));
            $msg = 'Project Updated Successfully.';
        }
        else {
            $project = new Project();
            $msg = 'Project Created Successfully.';
        }
    
        $project->project_name = $request->post('project_name');
        $project->save();
        return redirect()->route('projects')->with('success',$msg);
    }

    /**
     * Handle deleting a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('projects')->with('error', 'Project Deleted Successfully');
    }
}
