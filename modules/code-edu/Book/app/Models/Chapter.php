<?php namespace CodeEdu\Book\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model implements TableInterface
{
    protected $fillable = [
        'name',
        'content',
        'order',
        'book_id'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    /**
     * A List for headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['Capítulo', 'Nome'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case 'Capítulo':
                return $this->order;
            case 'Nome':
                return $this->name;
        }
    }
}
