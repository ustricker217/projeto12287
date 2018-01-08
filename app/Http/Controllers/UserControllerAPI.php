<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestChangePermission;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResources;
use Illuminate\Support\Facades\DB;


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
    public function create(Request $request)
    {

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
    public function show($user)
    {
        return new UserResources(User::find($user));
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

        $aux = $request->input("reason");
        $status = $request->input("estado");

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

    public function updateAdminPassword(Request $request)
    {
        $user = User::where('nickname', '=', 'admin')->first();
        $newPassword = bcrypt($request->input('newPassword'));

        $currentPassword = bcrypt($user->password);

        if ($newPassword == $currentPassword) {
            return response()->json("Password equal to previous password", 400);
        } else {
            $user->password = $newPassword;
            $user->save();
            return response()->json("message returned", 200);
        }
    }

    public function updateConfigMail(Request $request)
    {
        $newMail = $request->input('newMail');

        DB::table('config')->where('id', '=', 1)->update(['platform_email' => $newMail]);

        return response()->json(null, 200);
    }

    public function getStatistics($id)
    {
        $vitorias = 0;
        $derrotas = 0;
        $total = 0;
        $winnerID = null;
        //$userGames = GameUser::where('user_id', '=', $id);
        $userGames = DB::table('game_user')->select('game_id')->where('user_id', '=', $id)->get();

        //return response()->json(array('jogo' => $userGames));

        foreach ($userGames as $game_id) {
            $winnerID = DB::table('games')->where('id', '=', $game_id)->get();
            //return response()->json(array('jogo' => $winnerID));
            /*if($id == $winnerID) {
                $vitorias++;
            } else {
                $derrotas++;
            }
            $total++;*/
        }
        return response()-json(array('winner'=>$winnerID));
        //return response()->json(array('vitorias' => $vitorias, 'derrotas' => $derrotas, 'total' => $total,  ), 200);
    }
}
