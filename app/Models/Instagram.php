<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{
    use HasFactory;
    public $table = "instagram";
    protected $primaryKey = "ig";
    public $casts = ['ig' => 'string'];
}
