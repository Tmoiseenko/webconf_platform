<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class StatisticsController extends Controller
{
    public function joining(Request $request)
    {
        $event = Setting::first();
        $now = Carbon::now();
        $start = Carbon::parse($event->start_time);
        $end = Carbon::parse($event->end_time);

        if ($now >= $start && $now <= $end) {
            $statForUser = Statistic::where('user_id', $request->user_id)->whereNull('disconnected')->first();
            if (!$statForUser) {
                Statistic::create([
                    'user_id' => $request->user_id,
                    'connected' => $now,
                ]);
            }
        }
    }

    public function leaving(Request $request)
    {
        $event = Setting::first();
        $now = Carbon::now();
        $start = $event->start_time;
        $end = $event->end_time;
        $statForUser = Statistic::where('user_id', $request->user_id)->whereNull('disconnected')->first();

        if ($now >= $start && $now <= $end) {
            $statForUser->update(['disconnected' => $now]);
            return response('', 200);
        }

        if ($now > $end && !is_null($statForUser->connected)) {
            $statForUser->update(['disconnected' => $end]);
            return response('', 200);
        }

    }

    public function updating(Request $request)
    {
//        dd($request->users);

        $event = Setting::first();
        $now = Carbon::now();
        $start = $event->start_time;
        $end = $event->end_time;

        if ($now >= $start && $now <= $end) {
            foreach ($request->users as $user) {
                $statForUser = Statistic::where('user_id', $user['id'])->whereNull('disconnected')->first();
                if (!$statForUser) {
                    Statistic::create([
                        'user_id' => $user['id'],
                        'connected' => $now,
                    ]);
                }
            }

            $unfinishedSessions = Statistic::whereNull('disconnected')->pluck('user_id')->toArray();
            $currentUserIds = Arr::pluck($request->users, 'id');

            $leavedUsers = array_diff($unfinishedSessions, $currentUserIds);
            Statistic::whereIn('user_id', $leavedUsers)->whereNull('disconnected')->update(['disconnected' => $now]);
        }

        if ($now > $end) {
            Statistic::whereNull('disconnected')->update(['disconnected' => $now]);
            return response('', 200);
        }
    }
}
