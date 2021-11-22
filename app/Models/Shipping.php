<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';

    protected $table = 'transactions';
}
