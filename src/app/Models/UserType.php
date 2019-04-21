<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserType
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserType whereTitle($value)
 * @mixin \Eloquent
 */
class UserType extends Model
{
    const SUPER_ADMIN = 'super_admin';
    const CUSTOMER = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title',
    ];

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'name', 'title'
    ];

    /**
     * The users that belong to the user type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
