<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Session\Store;
use App\Book;
class ViewBookHandler
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    //tăng lượt xem dựa vào session -> middleware(filter) -> xác định thời gian tăng sau 30s (có thể sửa)
    //không sử dụng listen (vì nếu F5 thì view tăng lên 1)
    //nhằm tránh trường hợp F5 liên tục -> view tăng liên tục
//    public $book;
    private $session;

    /**
     * Create a new event instance.
     *
     * @param Store $session
     * @internal param Book $book
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle(Book $book)
{
    if (!$this->isBookViewed($book))
    {
        $book->increment('S_LUOTXEM');
        $this->storeBook($book);
    }
}

    private function isBookViewed($book)
    {
        $viewed = $this->session->get('viewed_books', []);

        return array_key_exists($book->S_MA, $viewed);
    }

    private function storeBook($book)
    {
        $key = 'viewed_books.' . $book->S_MA;

        $this->session->put($key, time());
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
