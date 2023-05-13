<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AHP extends Model
{
    use HasFactory;
    protected $table = 'ahp';
    protected $guarded = ['id'];
}
