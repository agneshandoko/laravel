<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NasProvider extends Model
{
    // Table name
    protected $table = 'nas';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
