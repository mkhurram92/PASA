<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\StoreRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('permission:role-list', ['only' => ['index', 'show','getPermissions']]);
        // $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $request)
    {
        return $request->render('page.roles.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        $html = view("models.role-create", compact('permissions',))->render();
        return response()->json(["status" => true, "html" => $html]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions(array_keys($request->permissions ?? []));
        return response()->json(["status" => true, "message" => "Role has been created"]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = Permission::join(
            'role_has_permissions',
            'role_has_permissions.permission_id',
            '=',
            'permissions.id'
        )
            ->where('role_has_permissions.role_id', $id)
            ->get()->toArray();
        $html = view("models.role-view", compact('role', 'permissions', 'rolePermissions'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        $rolePermissions = $role?->permissions()?->pluck("name")?->toArray();
        $html = view("models.role-update", compact('role', 'permissions', 'rolePermissions'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions(array_keys($request->permissions ?? []));
        return response()->json(["status" => true, "message" => "Role has been updated", "redirectTo" => route("roles.index")]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id', $id)->delete();
        return response()->json(["status" => true, "message" => "Role has been deleted"]);
    }
    public function getRoleJson(Request $request)
    {
        $roles = Role::when(!empty($request->searchTerm), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->searchTerm . '%');
        })
            ->orderBy('id')
            ->get();
        $response = [];
        foreach ($roles as $role) {
            $response[] = [
                'id' => $role->id,
                'text' => $role->name,
            ];
        }
        return $response;
    }
    public function getPermissions(Request $request, Role $role)
    {
        $permissions = $role->permissions()->get();
        $html = view('_partials.show-permissions', ["permissions" => $permissions, 'rolePermissions' => $permissions->pluck('name')->toArray()]);
        return $html;
    }
}
