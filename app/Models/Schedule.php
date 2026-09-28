<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_code',
        'day_name',
        'date_num',
        'date',
        'time',
        'title',
        'category',
        'category_label',
        'location',
        'coach',
        'description',
        'status',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
