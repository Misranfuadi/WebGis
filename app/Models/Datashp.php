<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datashp extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_shp',
        'data_shp',
        'data_size',
        'status',
        'note',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'id'
    ];


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function oneShp()
    {
        return $this->hasOne(Shp::class, 'id', 'id_shp');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
