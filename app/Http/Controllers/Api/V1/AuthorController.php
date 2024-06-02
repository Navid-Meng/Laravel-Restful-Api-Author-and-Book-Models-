<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AuthorResource;
use App\Http\Resources\V1\AuthorCollection;
use App\Filters\V1\AuthorsFilter;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AuthorsFilter();
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]
        
        $includeBooks = $request->query('includeBooks');

        $authors = Author::where($filterItems);

        if ($includeBooks){
            $authors = $authors->with('books');
        }

        return new AuthorCollection($authors->paginate()->appends($request->query()));
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
    public function store(StoreAuthorRequest $request)
    {
        return new AuthorResource(Author::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $includeBooks = request()->query('includeBooks');

        if ($includeBooks){
            return new AuthorResource($author->loadMissing('books'));
        }

        return new AuthorResource($author);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        if ( $author->update($request->all()) ){
            return response()->json(['message' => 'Author updated succcessfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $user = request()->user();
        
        if ($user != null && $user->tokenCan('delete')){
            $author->delete();
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
