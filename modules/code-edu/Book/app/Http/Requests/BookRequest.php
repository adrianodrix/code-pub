<?php

namespace CodeEdu\Book\Http\Requests;

use CodeEdu\Book\Repositories\Contracts\BookRepository;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BookRequest constructor.
     * @param \CodeEdu\Book\Repositories\Contracts\BookRepository $repository
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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => "required|max:200",
            'subtitle' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            'categories' => "required|array",
            'categories.*' => 'exists:categories,id',
            'dedication' => 'required',
            'description' => 'required',
            'website' => 'required|url',
            'percent_complete' => 'required|integer',
            'published' => 'boolean',
        ];
    }

    public function messages()
    {
        $result = [];
        $categories = $this->get('categories', []);
        $count = count($categories);
        if(is_array($categories) &&  $count > 0) {
            foreach (range(0, $count-1) as $value) {
                $field = \Lang::get('validation.attributes.categories_*', [
                    'num' => $value +1
                ]);
                $message = \Lang::get('validation.exists', [
                    'attribute' => $field
                ]);
                $result["categories.$value.exists"] = $message;
            }
        }
        return $result;
    }
}
