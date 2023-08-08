<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function groupUsers()
    {
        return $this->belongsToMany(UnitUser::class, 'group_user', 'group_id', 'user_id');
    }

    public $timestamps = false;
}
