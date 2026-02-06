<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'telefono',
        'codigo_telefono',
        'cedula',
        'fecha_nacimiento',
        'direccion',
        'provincia',
        'distrito',
        'corregimiento',
        'barrio',
        'email',
        'tienda',
        'tipo_cliente',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function compras()
    {
        return $this->hasMany(Orden::class , 'user_id')->orderBy('id' , 'desc');
    }

    public function nombreCompleto()
    {
        return $this->name . ' ' . $this->apellido;
    }
    
    public function favoritos()
    {
        return $this->hasMany(Favorito::class , 'user_id')->orderBy('nombre' , 'desc');
    }

    public function comprasLimit($limit = 50)
    {
        return Orden::where('user_id' , $this->id)->orderBy('id' , 'desc')->get();
    }
}
