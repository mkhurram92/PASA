<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use Illuminate\Http\Request;
use App\Models\Title;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $request)
    {
        $data = Title::all();

        return $request->render('page.title.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $html = view("models.user-create")->render();
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
        $user = Title::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json(["status" => true, "message" => "User created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        $html = view("models.user-view", compact('user'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Title $title)
    {
        $html = view("models.user-update", compact('user'))->render();
        return response()->json(["status" => true, "html" => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, Title $title)
    {
        $req = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if (!empty($request->password)) {
            $req['password'] = bcrypt($request->password);
        }
        $user = Title::where("id", $title->id)->update($req);

        return response()->json(["status" => true, "message" => "User updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        $title->delete();
        return response()->json(["status" => true, "message" => "User deleted successfully"]);
    }
}
