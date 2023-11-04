<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\follow;
use Illuminate\Http\Request;

class users extends BaseController
{

    public function profile($nama)
    {
        $result = User::where('username', $nama)->first();
        $follower = follow::where('id_user', $result->id_user)->count();
        $following = follow::where('id_follower', $result->id_user)->count();
        return [
            "Username" => $result->username,
            "First Name" => $result->Fname,
            "Last Name" => $result->Lname,
            "Phone Number" => $result->phone_number,
            "Birth Date" => $result->b_date,
            "Follower" => $follower,
            "Following" => $following,
        ];
    }
    public function finds($nama = null)
    {
        return
            $nama ? User::where('username', 'like', "%" . $nama . "%")
            ->orWhere('Fname', 'like', "%" . $nama . "%")
            ->orWhere('Lname', 'like', "%" . $nama . "%")
            ->get() : user::all();
    }
}
