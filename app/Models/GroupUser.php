<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
    ]; 

    public function unitUser()
    {
        return $this->belongsTo(UnitUser::class, 'user_id'); // UnitUserモデルとのリレーションを定義
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id'); // Groupモデルとのリレーションを定義
    }

    public $timestamps = false;
}
