<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use CrudTrait;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_name',
        'avatar',
        'image_sizes',
        'is_email_verified',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'image_sizes' => 'array',
    ];


    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->name . ' ' . $this->last_name;
    }


    // --- Relationships ---
    public function answers() : HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function questions() : HasMany
    {
        return  $this->hasMany(Question::class);
    }
}
