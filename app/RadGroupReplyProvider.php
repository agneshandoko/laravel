<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RadGroupReplyProvider extends Model
{
    // Table name
    protected $table = 'radgroupreply';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = 'false';
}
