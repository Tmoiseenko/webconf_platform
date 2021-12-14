<?php

namespace App\Orchid\Screens;

use App\Mail\SendAlarmMail;
use App\Mail\SendCalendarLinkMail;
use App\Mail\SendDay;
use App\Mail\SendHour;
use App\Models\Setting;
use App\Models\User;
use App\Orchid\Layouts\MailsSenderLayout;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class MailsSender extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.mails.index');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'mails' => [
                ['title' => __('admin.mails.sendCalendar'), 'slug' => 'sendCalendar'],
                ['title' => __('admin.mails.sendDaily'), 'slug' => 'sendDaily'],
                ['title' => __('admin.mails.sendHourly'), 'slug' => 'sendHourly'],
                ['title' => __('admin.mails.sendAlarm'), 'slug' => 'sendAlarm'],
            ]
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            MailsSenderLayout::class
        ];
    }

    public function sendTest($mail)
    {
        try {
            $user = auth()->user();
            switch ($mail){
                case 'sendCalendar':
                    $sendMailObj = new SendCalendarLinkMail(Setting::first());
                    break;
                case 'sendDaily':
                    $sendMailObj = new SendDay(Setting::first());
                    break;
                case 'sendHourly':
                    $sendMailObj = new SendHour(Setting::first());
                    break;
                case 'sendAlarm':
                    $sendMailObj = new SendAlarmMail(Setting::first());
            }

            Mail::to($user->email)->send($sendMailObj);

            Alert::success(__('admin.mail.sendingSuccess'));
        } catch (\Exception $exception) {
            Alert::success($exception->getMessage());
        }

    }

    public function sendAll($mail)
    {
        try {
            $users = User::whereHas('roles', function($q){
                $q->where('slug', 'user');}
            )->get();

            switch ($mail){
                case 'sendCalendar':
                    $sendMailObj = new SendCalendarLinkMail(Setting::first());
                    break;
                case 'sendDaily':
                    $sendMailObj = new SendDay(Setting::first());
                    break;
                case 'sendHourly':
                    $sendMailObj = new SendHour(Setting::first());
                    break;
                case 'sendAlarm':
                    $sendMailObj = new SendAlarmMail(Setting::first());
            }

            foreach ($users as $user) {
                Mail::to($user->email)->send($sendMailObj);
            }

            Alert::success(__('admin.mail.sendingSuccess'));
        } catch (\Exception $exception) {
            Alert::success($exception->getMessage());
        }
    }
}
