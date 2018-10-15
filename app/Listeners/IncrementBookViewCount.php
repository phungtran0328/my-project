<?php

namespace App\Listeners;

use App\Events\ViewBookHandler;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class IncrementBookViewCount
 * @package App\Listeners
 */
class IncrementBookViewCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ViewBookHandler  $event
     * @return void
     */
    public function handle(ViewBookHandler $event)
    {
//        $event->book->increment('S_LUOTXEM');
    }
}
