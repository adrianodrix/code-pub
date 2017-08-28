<?php

namespace CodePub\Http\Requests;

use CodePub\Repositories\Contracts\BookRepository;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BookRequest constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            $id = (int) $this->route('book');
            if ($id > 0) {
                $book = $this->repository->find($id);
                return ($book->author->id == \Auth::user()->id);
            } else {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('book');

        return [
            'title' => "required|max:200|unique:books,title,$id",
            'subtitle' => 'required|max:200',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }
}
