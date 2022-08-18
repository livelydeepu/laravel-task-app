<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Handle the user list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::get();
        $data = ['page_title'=>'Users', 'users'=>$users];
        return view('admin.users.list-users', $data);
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
            $result = User::where(['id' => $id])->get();
            $data['name'] = $result['0']->name;
            $data['email'] = $result['0']->email;
            $data['password'] = $result['0']->password;
            $data['role'] = $result['0']->role;
            $data['role_selected'] = "";
            if($result['0']->role == 1) {
                $data['role_selected'] = "checked";
            }
            $data['avatar'] = $result['0']->avatar;
            $data['id'] = $result['0']->id;
            $data['page_title'] = 'Edit User';
        }
        else {
            $data['name'] = '';
            $data['email'] = '';
            $data['password'] = '';
            $data['role'] = '';
            $data['role_selected'] = "";
            $data['avatar'] = '';
            $data['id'] = 0;
            $data['page_title'] = 'Add New User';
        }
        return view('admin.users.manage-user', $data);  
    }

    /**
     * Store a newly created resource in storage or Update existing resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        if($request->post('id') > 0) {
            $name = '';
            $email = '';
			$password = '';
            $avatar = 'mimes:jpeg,jpg,png';
        }
        else {
            $name = 'required';
            $email = 'required|unique:users,email,'.$request->post('id');
			$password = 'required|confirmed';
            $avatar = 'required|mimes:jpeg,jpg,png';
        }

        $data = $request->validate([
            'name' => $name,
            'email' =>  $email,
			'password' => $password,
            'avatar' => $avatar,
        ]);

        if($request->post('id') > 0) {
            $user = User::find($request->post('id'));
            $msg = 'User Updated Successfully.';
        }
        else {
            $user = new User();
            $msg = 'User Created Successfully.';
        }
        if($request->post('id') == 0) {
            $user->name = $request->post('name');
            $user->email = $request->post('email');
        }
        if(($request->post('id') > 0) && ($request->post('password') != "")) {
            $user->password = bcrypt($request->post('password'));
        } else {
            $user->password = bcrypt($request->post('password'));
        }
        $user->role = 0;
        if($request->post('role') !== null) {
            $user->role = 1;
        } 
        if($request->hasfile('avatar')) {
            if($request->post('id') > 0) {
                $avatar = DB::table('users')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('public/avatars/'.$avatar[0]->avatar)) {
                    Storage::delete('public/avatars/'.$avatar[0]->avatar);
                }
            }
            $image = $request->file('avatar');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('public/avatars/', $image_name);
            $user->avatar = $image_name;
        }
        $user->save();
        return redirect()->route('users')->with('success',$msg);
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
        if($request->post('id') > 0) {
            $avatar = DB::table('users')->where(['id'=>$id])->get();
            if(Storage::exists('/public/media/'.$avatar[0]->avatar)) {
                Storage::delete('/public/media/'.$avatar[0]->avatar);
            }
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')->with('error', 'User Deleted Successfully');
    }

    public function profile()
    {
        $user_id = Auth::user()->id;
        $users = User::where(['id' => $user_id])->get();
        $data = ['page_title'=>'Profile', 'users'=>$users];

        return view('admin.users.profile', $data);
    }
}
