<?php
namespace App\Models\Traits;

use App\Models\Like;

trait LikeTrait
{

    public function likes() {
        return $this->morphMany(Like::class, 'likeable')->where('like', true);
    }

    public function dislikes() {
        return $this->morphMany(Like::class, 'likeable')->where('like', false);
    }

    //current user liked
    public function userLiked($id)
    {
        return $this->likes->contains('user_id', $id);
    }

    //current user liked
    public function userDisLiked($id)
    {
        return $this->dislikes->contains('user_id', $id);
    }


    //two method for deleting like by passing  user id and get like  then delete it
    public function getIdLikedByUser($id)
    {
        return $this->likes->where('user_id', $id)->first();
    }

    public function getIdDislikedByUser($id) {
        return $this->dislikes->where('user_id', $id)->first();
    }

}
