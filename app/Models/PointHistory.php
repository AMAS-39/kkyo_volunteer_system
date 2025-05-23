<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'points',
        'reason',
        'added_by',
        'date',
    ];

    // (Optional) Relationship
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
}
