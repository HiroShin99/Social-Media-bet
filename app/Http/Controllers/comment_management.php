<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;

class comment_management extends Controller
{
    public function comment_post(Request $request)
    {
        $comment = new comment();
        $comment->id_user = $request->id_user;
        $comment->id_post = $request->id_post;
        $comment->comment = $request->comment;
        $result = $comment->save();
        if ($result) {
            return [
                "id_user" => $request->id_user,
                "id_post" => $request->id_post,
                "Komentar" => $request->comment,
            ];
        } else {
            return response();
        }
    }
}
