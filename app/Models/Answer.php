<?php

namespace App\Models;

use App\Models\Traits\LikeTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Answer extends Model
{
    use CrudTrait, LikeTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'answers';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function formattedDate(){
        return $this->created_at->format('d-m-Y H:m');
    }

    public function answeredByCurrentUser(User $user) : bool
    {
        return $this->user->id == $user->id;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /***
     * @return BelongsTo
     */

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /***
     */
    public function question()
    {
        return $this->morphOne(Answer::class, 'answers', 'answerable_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function answers() : MorphMany
    {
        return $this->morphMany(Answer::class, 'answerable');
    }


    public function parent() : BelongsTo
    {
        return $this->belongsTo(Answer::class, 'id', 'parent_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
