<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yadakhov\InsertOnDuplicateKey;

class Status extends Model
{
    use InsertOnDuplicateKey;

    protected $table = 'status';

    protected $fillable = [
        'id',
        'updated_at'
    ];
}
