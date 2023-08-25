<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdressUser extends Model
{
    use HasFactory;

    protected $table = 'address_users';

    protected $guarded = [];

    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
