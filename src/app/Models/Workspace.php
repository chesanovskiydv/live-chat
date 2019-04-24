<?php

namespace App\Models;

use Laratrust\Models\LaratrustTeam;

/**
 * App\Models\Workspace
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Visitor[] $visitors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkspaceApiKey[] $workspaceApiKeys
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Workspace whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Workspace extends LaratrustTeam
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'name', 'display_name', 'description',
    ];

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
