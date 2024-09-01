<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $request)
    {
        // Eager load the role and member relationships
        $users = User::with(['role', 'member'])->get();

        // Transform the data to include role name and member name
        $data = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'given_name' => $user->member ? $user->member->given_name : 'No given name',
                'family_name' => $user->member ? $user->member->family_name : 'No family name',
                'email' => $user->email,
                'role_name' => $user->role ? $user->role->name : 'No role assigned',
            ];
        });

        return $request->render('page.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        $html = view('models.user-create', compact('roles'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            //'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
        ]);

        return response()->json(["status" => true, "message" => "User created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roleName = $user->role ? $user->role->name : 'No role assigned';

        $html = view('models.user-view', compact('user', 'roleName'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $html = view("models.user-update", compact('user', 'roles'))->render();

        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Validate input
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable',
        ]);

        // Update user fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');

        // Update password if provided
        if ($request->filled('password')) {
            //$user->password = bcrypt($request->input('password'));
            $user->password = $request->input('password');
        }

        // Save changes
        $user->save();

        return response()->json(["status" => true, "message" => "User updated successfully"]);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["status" => true, "message" => "User deleted successfully"]);
    }
}
