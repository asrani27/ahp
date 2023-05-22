<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AHP_guru extends Model
{
    use HasFactory;
    protected $table = 'ahp_guru';
    protected $guarded = ['id'];
    public $timestamps = false;
}
