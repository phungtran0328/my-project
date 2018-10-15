<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class Filter
{
   private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $books = $this->getViewedBooks();

        if (!is_null($books))
        {
            $books = $this->cleanExpiredViews($books);
            $this->storeBooks($books);
        }
        return $next($request);
    }

    private function getViewedBooks()
    {
        return $this->session->get('viewed_books', null);
    }

    private function cleanExpiredViews($books)
    {
        $time = time();

        // Let the views expire after ten minutes.
        $throttleTime = 30;

        return array_filter($books, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storeBooks($books)
    {
        $this->session->put('viewed_books', $books);
    }
}
