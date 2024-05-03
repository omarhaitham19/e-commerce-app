<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:all-admins'], ['only' => ['index']]);
        $this->middleware(['permission:add-admins'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit-admins'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-admins'], ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $data = User::Where("type" , "admin")->latest()->paginate(5);
        return view('users.index',compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $check = $request->check;
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required',
        ]);
        $type = 'customer';

        if ($check == "1") {
            $type = "admin";
        }

        $input = $request->all();
        $input['type'] = $type;
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    // public function show($id)
    // {
    //     $user = User::find($id);
    //     return view('users.show',compact('user'));
    // }
    
    public function edit($id)
    {
        $user = User::FindOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles_name' => 'required',
            'type' => 'admin'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles_name'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');

    }
    
    public function destroy($id)
    {
        User::FindOrFail($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');

    }


    public function manageUser(){
        return view('users.manage_user');
    }


    public function searchUser(Request $request){
        $validate = $request->validate([
        'key' => 'required|email'
        ]);

        $key = $validate['key'];

        $users = User::where('email' , 'like' , "%$key%")->where("type" , "customer")->get();
        return view('users.manage_user' , compact("users"));

    }


    public function changeStatus($id){
        $user = User::FindOrFail($id);
        $newStatus = $user->status == 'active' ? 'inactive' : 'active';
        $user->update(['status' => $newStatus]);
        return redirect()->back();
    }

    public function deleteUser($id){
        $user = User::FindOrFail($id)->delete();
        session()->flash("success" , "user deleted successfully");
        return redirect()->back();
    }


}