<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuho extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'level',
        'report',
        'checked',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
