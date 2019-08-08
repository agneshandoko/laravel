<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadGroupCheckProvider extends Model
{
    // Table name
    protected $table = 'radgroupcheck';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
