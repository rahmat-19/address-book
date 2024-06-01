<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'phone_number',
        'address',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];

    public function scopeFillter($query, array $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" .  $search . "%")
                        ->orWhere("phone_number", "like", "%" .  $search . "%");
        });
        $query->when($filters["active"] ?? false, function ($query, $active) {
            return $query->where("active", $active);
        });
        $query->when($filters["category"] ?? false, function ($query, $category) {
            return $query->where("category", $category);
        });
    }
}
