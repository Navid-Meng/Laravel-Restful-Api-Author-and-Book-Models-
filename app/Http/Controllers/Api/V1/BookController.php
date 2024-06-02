<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BookResource;
use App\Http\Resources\V1\BookCollection;
use App\Filters\V1\BooksFilter;
use Illuminate\Http\Request;
use App\Http\Requests\BulkStoreBookRequest;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new BooksFilter($request);
        $filterItems = $filter->transform($request);

        if (empty($filterItems)){
            return new BookCollection(Book::paginate());
        } else{
            $books = Book::where($filterItems)->paginate();

            return new BookCollection($books->appends($request->query()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        
    }

    public function bulkStore(BulkStoreBookRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr, $key){
            return Arr::except($arr, ['authorId', 'publicationDate']);
        });

        Book::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
