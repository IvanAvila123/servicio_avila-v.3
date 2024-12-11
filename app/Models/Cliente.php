<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'direccion',
        'estado'
    ];

    public function expedientes()
    {
        return $this->hasMany(Expediente::class, 'cliente_id');
    }

    public function getHashIdAttribute()
    {
        $hashids = new Hashids(env('APP_KEY'), 10);
        return $hashids->encode($this->id);
    }

    public static function decodeHash($hash)
    {
        $hashids = new Hashids(env('APP_KEY'), 10);
        return $hashids->decode($hash)[0] ?? null;
    }
}
