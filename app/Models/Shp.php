<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Shp extends Model
{
    use HasFactory;


    protected $fillable = [
        'register',
        'peta',
        'keluaran',
        'id_rencana',
        'sumber_dokumen',
        'jenis_data',
        'id_alias',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'id'
    ];


    public function dataShp()
    {
        return $this->hasMany(Datashp::class, 'id_shp')->orderBy('created_at', 'desc');
    }

    public function countdataShp()
    {
        return $this->hasMany(Datashp::class, 'id_shp')->where('status', '1');
    }


    public function downloadShp()
    {
        return $this->hasOne(Datashp::class, 'id_shp')->where('status', '1')->orderBy('created_at', 'desc');
    }

    public function rencana()
    {
        return $this->belongsTo(Rencana::class, 'id_rencana');
    }

    public function alias()
    {
        return $this->belongsTo(Alias::class, 'id_alias');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
