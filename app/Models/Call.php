<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Call extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'client_id',
        'technician_id',
        'date_finalized',
        'service_type',
        'description_call',
        'email',
        'comments', 
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
