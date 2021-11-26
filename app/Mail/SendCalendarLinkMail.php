<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use Spatie\CalendarLinks\Link;
use \DateTime;

class SendCalendarLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $setting;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;

        $from = DateTime::createFromFormat('Y-m-d H:i:s', $setting->body['event_started_at']);
        $to = DateTime::createFromFormat('Y-m-d H:i:s', $setting->body['event_finished_at']);

        $link = Link::create($setting->body['event_name'], $from, $to)
                    ->description($setting->body['event_about'])
                    ->address($setting->body['event_address']);

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
                    ->subject('ИНФОСЭЛ')
                    ->attachData($this->data, 'event.ics', [
                        'mime' => 'text/calendar',
                    ]);;
    }
}
