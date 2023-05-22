<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AHP_kriteria extends Model
{
    use HasFactory;
    protected $table = 'ahp_kriteria';
    protected $guarded = ['id'];
    public $timestamps = false;
}
