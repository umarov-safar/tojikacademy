<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Answer;
use App\Models\Like;
use App\Models\Question;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function like(Request $request) {

        $likeableType = getModelNamespace($request->likeable_type);

        $liked = Like::updateOrCreate(
            [
               'likeable_type' => $likeableType,
               'likeable_id' => $request->likeable_id,
               'user_id' => \Auth::id()
            ],
            [
                'like' => true
            ]
        );

        if($liked) return back();

        return back();

    }

    public function dislike(Request $request)
    {
        $likeableType = getModelNamespace($request->likeable_type);

        $disliked = Like::updateOrCreate(
            [
                'likeable_type' => $likeableType,
                'likeable_id' => $request->likeable_id,
                'user_id' => \Auth::id()
            ],
            [
                'like' => false
            ]
        );

        if($disliked) return back();

        return back();

    }



    public function destroy($id)
    {
        $like = Like::destroy($id);
        if($like) return back();

        return back();
    }



}
