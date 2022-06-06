<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\CreateBookRatingRequest;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Repositories\BookRepository;
use App\Repositories\EmployeeRepository;

class BookController extends Controller
{

    private $bookRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function store(CreateBookRequest $request) {
        $user = $this->bookRepository->storeBook($request->validated());
        return response()->json($user, 201);
    }

    public function storeRating(CreateBookRatingRequest $request) {
        $user = $this->bookRepository->storeBookRating($request->validated());
        return response()->json($user, 201);
    }

    public function updateBook(UpdateBookRequest $request) {
        $user = $this->bookRepository->updateBook($request->validated());
        return response()->json($user, 201);
    }

    public function fetchBooks () {
        $users = $this->bookRepository->getBooks();

        return response()->json($users, 200);
    }

    public function fetchPaginatedBooks () {
        $users = $this->bookRepository->getPaginatedBooks();

        return response()->json($users, 200);
    }

    public function fetchBookById($book_id) {
        $user = $this->bookRepository->fetchBookById($book_id);

        return response()->json($user, 200);
    }

}
