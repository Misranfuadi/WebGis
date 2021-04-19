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


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
