<?php

namespace CodeEdu\User\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEdu\Book\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements TableInterface
{
    use Notifiable,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'author_id');
    }

    /**
     * Get Table Headers
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail'];
    }

    /**
     * Get Value for Headers
     *
     * @param string $header
     * @return mixed|string
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'E-mail':
                return $this->email;
        }
    }

    /**
     * Generate Password
     *
     * @return string
     */
    public static function generatePassword($password = null)
    {
        return is_null($password) ? bcrypt(str_random(8)) : bcrypt($password);
    }

    /**
     * Return Roles of User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Has Role by User
     *
     * @param Collection|String $role
     * @return bool
     */
    public function hasRole($role)
    {
        return is_string($role) ?
            $this->roles->contains('name', $role) :
            (bool) $role->intersect($this->roles)->count();
    }

    /**
     * Get Is Administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(config('codeeduuser.acl.role_admin'));
    }
}
