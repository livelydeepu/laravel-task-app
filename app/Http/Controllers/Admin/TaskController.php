<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Task;
use Auth;
use Storage;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Handle the tasks list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role == '0') {
            $user_role = Auth::user()->id;
            $user_id = Auth::user()->id;
            //$tasks = Task::where(['role' => '0', 'created_by' => $user_id])->with('project')->get();

            $tasks = Task::join('users', 'users.id', '=', 'tasks.created_by')->where(['users.role' => '0', 'created_by' => $user_id])->with('project')->get();
        } else {
            $user_id = Auth::user()->id;
            $tasks = Task::with('user')->with('project')->get();
        }

        $allTaskCount = Task::count();
        $openTaskCount = Task::where('status', 'Open')->count();
        $inprogressTaskCount = Task::where('status', 'Inprogress')->count();
        $completedTaskCount = Task::where('status', 'Completed')->count();
        $project = DB::table('projects')->get();

        $data = ['page_title'=>'Tasks', 'tasks'=>$tasks, 'allTaskCount'=>$allTaskCount, 'openTaskCount'=>$openTaskCount, 'inprogressTaskCount'=>$inprogressTaskCount, 'completedTaskCount'=>$completedTaskCount, 'project'=>$project];
    
        return view('admin.tasks.list-tasks', $data);
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
            $result = Task::where(['id' => $id])->get();
            $data['project_id'] = $result['0']->project_id;
            $data['task_title'] = $result['0']->task_title;
            $data['task_description'] = $result['0']->task_description;
            $data['priority'] = $result['0']->priority;
            $data['status'] = $result['0']->status;
            $data['created_by'] = $result['0']->created_by;
            $data['duedate'] = $result['0']->duedate;
            $data['id'] = $result['0']->id;
            $data['page_title'] = 'Edit Task';
        }
        else {
            $data['project_id'] = '';
            $data['task_title'] = '';
            $data['task_description'] = '';
            $data['priority'] = '';
            $data['status'] = '';
            $data['created_by'] = '';
            $data['duedate'] = '';
            $data['id'] = 0;
            $data['page_title'] = 'Add New Task';
        }
        $data['project'] = DB::table('projects')->get();
        return view('admin.tasks.manage-task', $data);  
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
            'task_title' => 'required|unique:tasks,task_title,'.$request->post('id'),
            'task_description' => 'required',
            'project_id' => 'required',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,Inprogress,Completed',
            'created_by' =>'required',
        ]);

        if($request->post('id') > 0) {
            $task = Task::find($request->post('id'));
            $msg = 'Task Updated Successfully.';
        }
        else {
            $task = new Task();
            $msg = 'Task Created Successfully.';
        }
        
        $task->project_id = $request->post('project_id');
        $task->task_title = $request->post('task_title');
        $task->task_description = $request->post('task_description');
        $task->priority = $request->post('priority');
        $task->status = $request->post('status');
        if($request->post('id') == 0) {
            $task->created_by = $request->post('created_by');
        }
        $task->save();
        return redirect()->route('tasks')->with('success',$msg);
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
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks')->with('success', 'Task Deleted Successfully');
    }

    /**
     * Update Priority.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response redirect route to show the Tasks
     */
    public function updatePriority(Request $request)
    {
        $tasks = Task::all();

        print_r($request);

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->priority as $priority) {
                if ($priority['id'] == $id) {
                    $task->update(['priority' => $priority['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }
}
