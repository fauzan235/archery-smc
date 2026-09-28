<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_code',
        'name',
        'nisn',
        'class',
        'major',
        'division',
        'role',
        'phone',
        'status',
        'dues_status',
        'attendance_rate',
        'avatar',
        'join_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
