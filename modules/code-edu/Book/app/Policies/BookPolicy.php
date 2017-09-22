<?php namespace CodeEdu\Book\Policies;

use CodeEdu\User\Models\User;
use CodeEdu\Book\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->can('books/all')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the book.
     *
     * @param  \CodeEdu\User\Models\User  $user
     * @param  \CodeEdu\Book\Models\Book  $book
     * @return mixed
     */
    public function view(User $user, Book $book)
    {
        //
    }

    /**
     * Determine whether the user can create books.
     *
     * @param  \CodeEdu\User\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  \CodeEdu\User\Models\User  $user
     * @param  \CodeEdu\Book\Models\Book  $book
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
        return ($user->id == $book->author_id);
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \CodeEdu\User\Models\User  $user
     * @param  \CodeEdu\Book\Models\Book  $book
     * @return mixed
     */
    public function delete(User $user, Book $book)
    {
        return ($user->id == $book->author_id);
    }
}
