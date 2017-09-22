<?php

namespace CodeEdu\User\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements TableInterface
{
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Return Permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Return Permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get Table Headers
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Descrição'];
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
            case 'Descrição':
                return $this->description;
        }
    }
}
