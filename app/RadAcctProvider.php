<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadAcctProvider extends Model
{
    // Table name
    protected $table = 'radacct';
    // Primary key
    public $primaryKey = 'radacctid';
    // Timestamp
    public $timestamps = 'false';
}
