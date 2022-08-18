<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Task;
use App\Models\Admin\Project;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectCount = Project::count();
        $allTaskCount = Task::count();
        $openTaskCount = Task::where('status', 'Open')->count();
        $inprogressTaskCount = Task::where('status', 'Inprogress')->count();
        $completedTaskCount = Task::where('status', 'Completed')->count();

        $data = ['page_title'=>'Dashboard', 'projectCount'=>$projectCount, 'allTaskCount'=>$allTaskCount, 'openTaskCount'=>$openTaskCount, 'inprogressTaskCount'=>$inprogressTaskCount, 'completedTaskCount'=>$completedTaskCount];
        return view('admin.dashboard', $data);
    }

    /**
     * Logout from the application and redirect to Login.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out');
    }
}
