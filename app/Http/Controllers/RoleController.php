<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware(['permission:role-list'], ['only' => ['index']]);
        $this->middleware(['permission:role-show'], ['only' => ['show']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $permissions = $request->input('permission');

        $permissions = array_map(function ($item) {
          return (int)$item;
        }, $permissions);
           
        if (!empty($permissions)){
          $role->syncPermissions($permissions);
        }
        session()->flash("add");
        return redirect()->route('roles.index');
           
    }

    public function show($id)
    {
        $role = Role::FindOrFail($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::FindOrFail($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::FindOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        $permissions = $request->input('permission');

        $permissions = array_map(function ($item) {
          return (int)$item;
        }, $permissions);
           
        if (!empty($permissions)){
          $role->syncPermissions($permissions);
        }
        session()->flash("edit");
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        session()->flash("delete");
        return redirect()->route('roles.index');
    }
}