<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class WordCategory extends Model
{
    use CrudTrait;

    /**
     * These specials categories will not be show when the user choose categories for words
     */
    const  SPECIALS_SLUGS = [
        'specials/verb',
        'specials/noun',
        'specials/adjective',
        'specials/masculine',
        'specials/feminine',
        'specials/neutral',
    ];

    const SPECIALS_SLUG_FOR_RUSSIAN_WORDS = [
        'specials/masculine',
        'specials/feminine',
        'specials/neutral',
    ];
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'word_categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Returns the words related with russian word  with specific category
     */
    public function russianWords()
    {
        return $this->belongsToMany(RussianWord::class, 'russian_word_pivot_category', 'word_category_id', 'word_id');
    }

    /**
     * Returns the words related with english word  with specific category
     */
    public function englishWords()
    {
        return $this->belongsToMany(EnglishWord::class, 'english_word_pivot_category', 'word_category_id', 'word_id');
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
