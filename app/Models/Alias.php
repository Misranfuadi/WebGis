<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Alias extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'aliases';

    protected $fillable = [
        'alias',
        'nama_field',
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


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
