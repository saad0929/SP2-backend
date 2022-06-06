<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\CreateBookRatingRequest;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Repositories\BookRepository;
use App\Repositories\BookRequestRepository;
use App\Repositories\EmployeeRepository;
use App\Http\Requests\BookLend\BookLendRequest\CreateBookLendRequest;
use App\Http\Requests\BookLend\BookLendRequest\UpdateBookLendRequest;

class BookRequestController extends Controller
{

    private $bookrequestRepository;

    public function __construct()
    {
        $this->bookrequestRepository = new BookRequestRepository();
    }

    public function store(CreateBookLendRequest $request) {
        $user = $this->bookrequestRepository->storeBookingRequest($request->validated());
        return response()->json($user, 201);
    }

    public function updateLendRequest(UpdateBookLendRequest $request) {
        $user = $this->bookrequestRepository->updateBookLend($request->validated());
        return response()->json($user, 201);
    }

    public function fetchBookLendPendingRequests () {
        $users = $this->bookrequestRepository->getBookLendPendingRequests();

        return response()->json($users, 200);
    }

    public function fetchBookLendPendingRequestsPaginated () {
        $users = $this->bookrequestRepository->getPaginatedBooks();

        return response()->json($users, 200);
    }

    public function fetchUserBookingRequests ($user_id) {
        $requestss =  $this->bookrequestRepository->getUserBookingRequests($user_id);

        return response()->json($requestss, 200);
    }

    public function fetchUserBookings ($user_id) {
        $requestss =  $this->bookrequestRepository->getUserBookings($user_id);

        return response()->json($requestss, 200);
    }
    public function fetchUserExceededBookings () {
        $requestss =  $this->bookrequestRepository->getTimeExccededBookings();

        return response()->json($requestss, 200);
    }

    public function fetchBookById($book_id) {
        $user = $this->bookrequestRepository->fetchBookById($book_id);

        return response()->json($user, 200);
    }

}
