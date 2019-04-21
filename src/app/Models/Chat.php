<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Chat
 *
 * @property int $id
 * @property int $visitor_id
 * @property int $visitor_unread_messages_count
 * @property int $user_unread_messages_count
 * @property \Illuminate\Support\Carbon|null $messaged_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \App\Models\Visitor $visitor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereMessagedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereUserUnreadMessagesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereVisitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chat whereVisitorUnreadMessagesCount($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visitor_unread_messages_count', 'user_unread_messages_count',
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'visitor_unread_messages_count', 'user_unread_messages_count', 'messaged_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visitor_unread_messages_count' => 'integer',
        'user_unread_messages_count' => 'integer',
        'messaged_at' => 'datetime',
    ];

    /**
     * Get the visitor that owns the chat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    /**
     * The messages that belong to the chat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
