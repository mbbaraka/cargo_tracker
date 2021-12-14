<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';

    protected $primaryKey = 'txn_id';

    protected $table = 'transactions';

    public function origins () {
        return $this->belongsTo(Location::class, 'txn_id');
    }
}
