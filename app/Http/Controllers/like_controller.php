<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\like;

class like_controller extends Controller
{

    public function like_post(Request $request)
    {
        $like = new like();
        $like->id_user = $request->id_user;
        $like->id_post = $request->id_post;
        $result = $like->save();
        if ($result) {
            return [
                "id_user" => $request->id_user,
                "id_post" => $request->id_post,
            ];
        } else {
            return response();
        }
    }
}
