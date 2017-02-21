<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Yadakhov\InsertOnDuplicateKey;

/**
 * Class Thread
 *
 * @package App
 */
class Thread extends Model
{
    use Notifiable, InsertOnDuplicateKey, Searchable;

    protected $fillable = [
        'url',
        'title',
        'description',
        'author',
        'lastPostAuthor',
        'startDate',
        'lastPostDate',
        'rating',
        'sticky',
        'views',
        'replies',
        'pages',
        'sentiment',
    ];

    /**
     * @param array $threads
     */
    public static function store(array $threads)
    {
        Thread::insertOnDuplicateKey($threads, [
            'lastPostAuthor',
            'lastPostDate',
            'rating',
            'views',
            'replies',
            'pages',
            'indexed',
        ]);
    }
}