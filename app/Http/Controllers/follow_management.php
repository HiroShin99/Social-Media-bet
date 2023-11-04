<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\follow;

class follow_management extends Controller
{
    public function following(Request $request)
    {
        $follow = new follow();
        $follow->id_user = $request->id_user;
        $follow->id_follower = $request->id_follower;
        $result = $follow->save();
        if ($result) {
            return [
                "id_follower" => $request->id_follower,
                "mengikuti id_user" => $request->id_user,
            ];
        } else {
            return response();
        }
    }
    public function unfollow(Request $request)
    {
        $follow = new follow();
        $follow->id_user = $request->id_user;
        $follow->id_follower = $request->id_follower;
        $result = $follow
            ->where('id_user', "=", $request->id_user)
            ->where('id_follower', "=", $request->id_follower)
            ->delete();
        if ($result) {
            return "berhasil";
        } else {
            return response();
        }
    }
}
