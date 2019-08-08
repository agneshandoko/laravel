<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadReplyProvider extends Model
{
    // Table name
    protected $table = 'radreply';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
