<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Expr\Cast\Bool_;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    const ADMIN = 1;
    const USUARIO = 0;
    
    const ROLES = [
        self::ADMIN => 'Admin',
        self::USUARIO => 'Usuário',
    ];
    
    protected $fillable = [
        'first_name',
        'last_name',
        'rg',
        'cpf',
        'contact',
        'email',
        'password', 
        'is_admin'
    ];

    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $table = 'users';


    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];
    
    public function address()
    {
        return $this->hasMany(AdressUser::class, 'user_id');
    }
}
