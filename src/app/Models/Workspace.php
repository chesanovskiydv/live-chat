<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Workspace
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Visitor[] $visitors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkspaceApiKey[] $workspaceApiKeys
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Workspace onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Workspace withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Workspace withoutTrashed()
 * @mixin \Eloquent
 */
class Workspace extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'title'
    ];

    /**
     * The users that belong to the workspace.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * The visitors that belong to the workspace.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    /**
     * The workspace api keys that belong to the workspace.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workspaceApiKeys()
    {
        return $this->hasMany(WorkspaceApiKey::class);
    }
}
