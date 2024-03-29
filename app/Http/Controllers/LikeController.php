<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = 3;
        $like = Like::where('user_id', $user)->where('post_id', $id)->get();
    }

    public function update2($id)
    {

        $user = Auth::User();

        $like = Like::where('user_id', $user->id)->where('post_id', $id)->first();

        if ($like) {
            $like->State = !$like->State;
            $like->save();
        } else {
            $like = Like::create([
                "user_id" => $user->id,
                "post_id" => $id,
                "State" => true
            ]);
        }

        // dd($like);

        return Redirect::back();
    }
}
