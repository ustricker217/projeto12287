<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestChangePermission;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResources;


class UserControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return UserResources::collection(User::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'age' => 'integer|between:18,75'
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }

    public function blockUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        //dd($request->input("reason"));
        $aux = $request->input("reason");
        $status = $request->input("estado");
        //dd($aux);
        if ($status) {
            $user->reason_blocked = null;
            $user->reason_reactivated = $aux;
            $user->blocked = 0;

        } else {
            $user->reason_reactivated = null;
            $user->reason_blocked = $aux;
            $user->blocked = 1;
        }
        $user->save();

        return response()->json(null, 200);
    }
}
