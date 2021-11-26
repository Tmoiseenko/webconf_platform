<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendCalendar;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use App\Mail\SendCalendarLinkMail;

class SendCalendarLink
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
     * @param  object  $event
     * @return void
     */
    public function handle(SendCalendar $event)
    {
        $setting = Setting::first();
        Mail::to($event->user->email)->send(new SendCalendarLinkMail($setting));
    }
}
