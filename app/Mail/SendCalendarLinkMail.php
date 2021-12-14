<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use Spatie\CalendarLinks\Link;
use Illuminate\Support\Carbon;

class SendCalendarLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Setting $setting)
    {
        $this->event = $setting;

        $from = Carbon::parse($setting->started_at);
        $to = Carbon::parse($setting->finished_at);

        $link = Link::create($setting->title, $from, $to)
                    ->description($setting->description)
                    ->address(env('APP_URL'));

                    $this->data = base64_decode(str_replace('data:text/calendar;charset=utf8;base64,','',$link->ics()));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_calendar')
                    ->subject(env('APP_NAME'))
                    ->attachData($this->data, 'event.ics', [
                        'mime' => 'text/calendar',
                    ]);;
    }
}
