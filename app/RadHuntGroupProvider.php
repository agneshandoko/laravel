<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadHuntGroupProvider extends Model
{
    // Table name
    protected $table = 'radhuntgroup';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
