<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.authorId' => ['required', 'integer'],
            '*.title' => ['required'],
            '*.publicationDate' => ['required', 'date'],
            '*.genre' => ['required'],
            '*.price' => ['required', 'numeric', 'min:0'],
            '*.summary' => ['nullable']
        ];
    }

    protected function prepareForValidation(){
        $data = [];
        foreach($this->toArray() as $obj){
            $obj['author_id'] = $obj['authorId'] ?? null;
            $obj['publication_date'] = $obj['publicationDate'] ?? null;

            $data[] = $obj;
        }
        $this->merge($data);
    }
}
