<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookCollection;
use App\Models\Book;
use App\Models\Publisher;

class BooksController extends Controller
{
    /**
     * @OA\Get(
     *      path="/books",
     *      operationId="getBooks",
     *      tags={"Books"},
     *      summary="Get list of books",
     *      description="Get list of books",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     *
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BookCollection(Book::paginate(1));
    }

    /**
     *   @OA\Post(
     *   path="/books",
     *   summary="store book",
     *   description="store book",
     *   operationId="storeBook",
     *   tags={"Books"},
     *      @OA\RequestBody(
     *      required=true,
     *      description=" ** if we will use api with authentication, we don't need to send publisher_id <br>1. if you want to add an existing book then send the only book id and publisher id !<br>2. if you want to add a new book don't send book_id, then send only book_name,publisher_id and book's authors_id as array",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="book_id", type="integer", example=1
     *              ),
     *              @OA\Property( property="publisher_id", type="integer", example="1"),
     *              @OA\Property( property="book_name", type="string"),
     *              @OA\Property( property="authors_id", example="[1,2]"),
     *          ) ,
     *      ),
     *      @OA\Response(
     *        response=404,
     *        description="Book not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Sorry, book not found"),
     *          )
     *      ),
     *      @OA\Response(
     *        response=200,
     *        description="Book stored",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Book stored successfully"),
     *          )
     *      ),
     *
     *   )
     */

    public function store(Request $request)
    {
        if(!empty($request->book_id)){

            $book=Book::find($request->book_id);

            if(!$book){
                return response(['success'=>false, 'message'=>'Sorry, book not found'], 404);
            }

            $book->publishers()->attach($request->publisher_id);
            
            return response(['success'=>true, 'message'=>'Book stored successfully'], 200);

        }else{

            $book=Book::create(['name'=>$request->book_name]);
            
            $book->publishers()->attach($request->publisher_id);
            
            $book->authors()->attach($request->authors_id);

            return response(['success'=>true, 'message'=>'Book stored successfully'], 200);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     *   @OA\Put(
     *   path="/books/{id}",
     *   summary="update book",
     *   description="update book",
     *   operationId="updateBook",
     *   tags={"Books"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="book id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *      required=true,
     *      description=" ** send new book name and new authors_id ",
     *         @OA\JsonContent(
     *              @OA\Property( property="book_name", type="string"),
     *              @OA\Property( property="authors_id", example="[1,2]"),
     *          ) ,
     *      ),
     *      @OA\Response(
     *        response=404,
     *        description="Book not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Sorry, book not found"),
     *          )
     *      ),
     *      @OA\Response(
     *        response=200,
     *        description="Book updated",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Book updated successfully"),
     *          )
     *      ),
     *
     *   )
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $book=Book::find($id);

        if(!$book){
            return response(['success'=>false, 'message'=>'Sorry, book not found'], 404);
        }
        
        $book->update(['name'=>$request->book_name]);

        $book->authors()->sync($request->authors_id);
    
        return response(['success'=>true, 'message'=>'Book updated successfully'], 200);

    }
    /**
     * 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  
     * @OA\Delete(
     *      path="/books/{id}",
     *      operationId="deleteBooks",
     *      tags={"Books"},
     *      summary="delete books",
     *      description="delete books for publishers",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="book id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="if we will use api with authentication, we wouldn't send publisher_id",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="publisher_id", type="integer", example=1
     *              ),
     *          ) ,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       )
     *     )
     */

    public function destroy($book_id)
    {
        $publisher=Publisher::find(request()->publisher_id);
        /*
            if we will use api with authentication, in that case $publisher will be equal to $request->user(), 
            $publisher=request()->user();
        */
        $publisher->books()->detach($book_id);

        return response(['success'=>true, 'message'=>'Book deleted from publisher'], 200);
        
    }
}
