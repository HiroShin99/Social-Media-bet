<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\like;
use Illuminate\Http\Request;
use App\Models\post;

class post_ct extends Controller
{
    public function index()
    {
        $post = new post();
        $like = new like();
        $comment = new comment();
        $data = $post->all();
        $group = array();
        foreach ($data as $pt) {
            $group[] = [
                "id_post" => $pt->id_post,
                "caption" => $pt->caption,
                "image" => $pt->img_url,
                "Like " => $like::where("id_post", $pt->id_post)->count(),
                "Komentar " => $comment::where("id_post", $pt->id_post)->get('comment'),
            ];
        };
        return $group;
    }

    public function new_post(Request $request)
    {

        $images = $request->file('image');
        $postcode = rand();
        if (!file_exists('upload/post/' . $postcode)) {
            mkdir('upload/post/' . $postcode, 0777, true);
        } else {
            $postcode = $postcode . rand();
            mkdir('upload/post/' . $postcode, 0777, true);
        }
        $imageNames = '';
        $urutanGambar = 0;
        foreach ($images as $image) {
            $urutanGambar = $urutanGambar + 1;
            $new_name = $image->getClientOriginalName();
            $imageNames = $urutanGambar . "_" . $imageNames . $new_name . ",";
            $image->move(public_path('upload/post/' . $postcode), $urutanGambar . "_" . $new_name);
        }


        $post = new post;
        $post->user_id = $request->user_id;
        $post->caption = $request->caption;
        $post->img_url = $postcode;
        $post->image = $imageNames;
        $result = $post->save();
        if ($result) {
            return [
                "id_user" => $request->user_id,
                "Caption" => $request->caption,
                "Gambar upload" => $imageNames,
                "Directory folder" => "upload/post/" . $postcode
            ];
        } else {
            return ["Status :" => " Gagal"];
        }
    }
}
