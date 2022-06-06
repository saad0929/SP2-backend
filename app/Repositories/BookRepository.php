<?php


namespace App\Repositories;


use App\Handlers\UserTokenHandler;
use App\Models\Book;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
//use Nette\Utils\Image;

class BookRepository
{

    public function getBooks() {
       $books = Book::get();
       return $books;
    }
    public function getPaginatedBooks(){
        $books = Book::paginate(15);
        return $books;
    }

    public function storeBook(array $request) {
      $book = new Book();
      $book->name = $request['name'];
      $book->author = $request['author'];
      $book->category = $request['category'];
      if($request['description'])
          $book->description = $request['description'];

    //   if ($request['image']) {
    //         $filename = $this->random_string(5) . time() . '.' . explode(';', explode('/', $request['image'])[1])[0];
    //         $location = public_path('/images/books/' . $filename);

    //         Image::make($request['image'])->save($location);
    //       $book->image = $filename;
    //   }

        $book->save();
      return $book;
    }

    public function storeBookRating(array $request) {
        $book = Book::where('id', $request['id'])->firstOrFail();
        $book->rating = ($book->rating + $request['rating'])/2.0;

        $book->save();
        return $book;
    }
    public function updateBook(array $request) {
        $book = Book::where('id', $request['id'])->firstOrFail();
        $book->name = $request['name'];
        $book->author = $request['author'];
        $book->category = $request['category'];
        if($request['description'])
            $book->description = $request['description'];

        // if ($request['image']) {
        //     $filename = $this->random_string(5) . time() . '.' . explode(';', explode('/', $request['image'])[1])[0];
        //     $location = public_path('/images/books/' . $filename);

        //     Image::make($request['image'])->save($location);
        //     $book->image = $filename;
        // }
        $book->save();
        return $book;
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
