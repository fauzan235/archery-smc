<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_code',
        'member_id',
        'member_name',
        'type',
        'category',
        'amount',
        'period',
        'payment_method',
        'status',
        'date',
        'description',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
