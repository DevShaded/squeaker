<?php

namespace App\Models\Post;

use App\Models\User;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Uuid;

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    public $incrementing = false;

    protected $table = 'replies';

    protected $fillable = [
        'user_id',
        'comment_id',
        'content',
    ];

    protected $hidden = [
        'laravel_through_key',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
