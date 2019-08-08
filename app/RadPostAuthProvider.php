<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadPostAuthProvider extends Model
{
    // Table name
    protected $table = 'radpostauth';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
