<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdressClient extends Model
{
    use HasFactory;

    protected $table = 'address_clients';

    protected $guarded = [];

    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
