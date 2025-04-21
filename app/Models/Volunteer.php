<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'user_code',
        'department_code',
        'points',
    ];

    public function pointHistories()
    {
        return $this->hasMany(PointHistory::class);
    }
}
