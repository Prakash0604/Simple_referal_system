<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class networks extends Model
{
    use HasFactory;
    // Protected $primarykey="id";
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
