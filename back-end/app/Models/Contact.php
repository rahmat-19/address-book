<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $with = ['user'];
    protected $fillable = [
        'name',
        'category',
        'phone_number',
        'address',
        'active',
        'user_id',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFillter($query, array $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" .  $search . "%")
                        ->orWhere("phone_number", "like", "%" .  $search . "%");
        });
        $query->when(isset($filters["active"]), function ($query) use ($filters) {
            return $query->where("active", $filters["active"]);
        });
        $query->when($filters["category"] ?? false, function ($query, $category) {
            return $query->where("category", $category);
        });
    }
}
