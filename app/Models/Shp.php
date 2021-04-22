<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
