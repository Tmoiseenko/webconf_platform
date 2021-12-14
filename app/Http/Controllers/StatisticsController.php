<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class StatisticsController extends Controller
{
    public function joining(Request $request)
    {
        Log::info('StatisticsController joining ');
        $event = Setting::first();
        $now = Carbon::now();
        $start = Carbon::parse($event->start_time);
        $end = Carbon::parse($event->end_time);

        if($now >= $start && $now <= $end) {
            Log::info('interval true');
            $statForUser = Statistic::where('user_id', $request->user_id)->first();
            if(is_null($statForUser)) {
                Log::info('connected create');
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
        $statForUser = Statistic::where('user_id', $request->user_id)->first();

        if($now >= $start && $now <= $end) {
            if(!is_null($statForUser)) {
                if(is_null($statForUser->disconnected)) {
                    $statForUser->update([
                        'disconnected' => $now,
                    ]);
                    return response('', 200);
                }

                if($statForUser->disconnected <= $now) {
                    $statForUser->update([
                        'disconnected' => $now,
                    ]);
                    return response('', 200);
                }
            }
        }

        if($now > $end && !is_null($statForUser->connected)) {
            $statForUser->update([
                'disconnected' => $end,
            ]);
            return response('', 200);
        }

    }
}
