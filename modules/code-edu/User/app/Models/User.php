<?php

namespace CodeEdu\User\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEdu\Book\Models\Book;
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
        'name', 'email', 'password',
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

    /*public function books(){
        return $this->hasMany(Book::class);
    }*/
    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail', 'Roles'];
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
            case 'Roles':
                return ''; //$this->roles->implode('name', ' | ');
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
}