<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\WorkspaceApiKey
 *
 * @property int $id
 * @property int $workspace_id
 * @property string $title
 * @property string $api_key
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Workspace $workspace
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkspaceApiKey onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WorkspaceApiKey whereWorkspaceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkspaceApiKey withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WorkspaceApiKey withoutTrashed()
 * @mixin \Eloquent
 */
class WorkspaceApiKey extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'api_key', 'is_active'
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'title', 'api_key', 'is_active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the workspace that owns the api key.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
