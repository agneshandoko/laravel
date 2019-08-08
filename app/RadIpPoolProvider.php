<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadIpPoolProvider extends Model
{
    // Table name
    protected $table = 'radippool';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
