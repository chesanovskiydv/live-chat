<?php

namespace App\Models;

use App\Support\Traits\Eloquent\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Visitor
 *
 * @property int $id
 * @property string $uuid
 * @property int $workspace_id
 * @property string|null $user_id
 * @property string|null $name
 * @property string|null $email
 * @property array|null $custom_attributes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chats
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $messages
 * @property-read \App\Models\Workspace $workspace
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereCustomAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereWorkspaceId($value)
 * @mixin \Eloquent
 */
class Visitor extends Model
{
    use Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'custom_attributes'
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'uuid', 'user_id', 'name', 'email', 'custom_attributes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'custom_attributes' => 'array',
    ];

    /**
     * Get the workspace that owns the visitor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * Get all of the visitor's messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    /**
     * The chats that belong to the visitor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
