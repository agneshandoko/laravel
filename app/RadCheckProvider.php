<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadCheckProvider extends Model
{
    // Table name
    protected $table = 'radcheck';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
