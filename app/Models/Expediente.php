<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expediente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'equipo',
        'problema',
        'refacciones',
        'refacciones',
        'fecha',
        'observacion',
        'costo',
        'pdf',
        'estadoExpediente',
        'deleted_at',
        'order',
        'id_cliente',
        'id_inventarios',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'id_inventarios');
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
