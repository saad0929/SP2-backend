<?php


namespace App\Repositories;


use App\Handlers\UserTokenHandler;
use App\Models\Book;
use App\Models\BookRequests;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Nette\Utils\Image;

class BookRequestRepository
{

    public function getBookLendPendingRequests() {
        $books = BookRequests::get();
    //   $books = BookRequests::where('is_accepted', 0)->get();
    //   $books->load('user', 'book');
      return $books;
    }
    public function getPaginatedBooks(){
        $books = BookRequests::where('is_accepted', 0)->paginate(15);
        $books->load('user', 'book');
        return $books;
    }

    public function getUserBookingRequests($user_id) {
        $books = BookRequests::where('is_accepted', 0)
            ->where('user_id', $user_id)->get();
        $books->load('user', 'book');
        return $books;
    }
    public function getUserBookings($user_id) {
        $books = BookRequests::where('is_accepted', 1)
            ->where('user_id', $user_id)->get();
        $books->load('user', 'book');
        return $books;
    }
    public function getTimeExccededBookings() {
        $books = BookRequests::where('is_accepted', 1)
            ->where('is_returned', 1)
            ->where('end_date', '<', Carbon::now())
            ->get();
        $books->load('user', 'book');
        return $books;
    }


    public function storeBookingRequest(array $request) {
        $bookLend = new BookRequests();
        $bookLend->user_id = $request['user_id'];
        $bookLend->book_id = $request['book_id'];
        $bookLend->start_date = Carbon::parse($request['start_date']);
        $bookLend->end_date = Carbon::parse($request['end_date']);
        $bookLend->user_name = $request['user_name'];
        $bookLend->book_name = $request['book_name'];
        $bookLend->save();
        return $bookLend;
    }

    public function updateBookLend(array $request) {
        $bookLend = BookRequests::where('id', $request['id'])->firstOrFail();
        $bookLend->user_id = $request['user_id'];
        $bookLend->book_id = $request['book_id'];
        $bookLend->start_date = Carbon::parse($request['start_date']);
        $bookLend->end_date = Carbon::parse($request['end_date']);
        $bookLend->is_accepted = $request['is_accepted'];
        $bookLend->is_returned = $request['is_returned'];
        $bookLend->user_name = $request['user_name'];
        $bookLend->book_name = $request['book_name'];
        $bookLend->save();
        return $bookLend;
    }

    public function fetchBookById($book_id)
    {
        $book = Book::where('id', $book_id)->firstOrFail();
        return $book;
    }

    function random_string($length)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
