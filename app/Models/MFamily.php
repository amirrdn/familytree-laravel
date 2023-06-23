<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MFamily extends Model
{
    use HasFactory;
    protected $table    = 'familytree';
    protected $fillable = ['id', 'name', 'gender', 'parent'];
}
