<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
        'phone',
        'position',
        'company',
        'status_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    protected $with = ['roles'];

    public function statistics() {
        return $this->hasMany(Statistic::class, 'user_id');
    }

    public function getTotalAttribute()
    {
        $totalInSeconds = \Carbon\Carbon::parse($this->created_at)->diffInSeconds(\Carbon\Carbon::parse(Carbon::now()));

        \Carbon\Carbon::setLocale('ru');

        \Carbon\CarbonInterval::setCascadeFactors([
            'minute' => [60, 'seconds'],
            'hour' => [60, 'minutes'],
            'day' => [24, 'hours'],
        ]);

        return $totalInSeconds > 0 ? \Carbon\CarbonInterval::seconds($totalInSeconds)->cascade()->forHumans() : '-';
    }

    public function getEventTimeAttribute() {
        $statistics = $this->statistics;
        $totalInSeconds = 0;

        foreach($statistics as $session) {
            $totalInSeconds += \Carbon\Carbon::parse($session->connected)->diffInSeconds(\Carbon\Carbon::parse($session->disconnected));
        }

        \Carbon\Carbon::setLocale('ru');

        \Carbon\CarbonInterval::setCascadeFactors([
            'minute' => [60, 'seconds'],
            'hour' => [60, 'minutes'],
            'day' => [8, 'hours'],
        ]);

        return $totalInSeconds > 0 ? \Carbon\CarbonInterval::seconds($totalInSeconds)->cascade()->forHumans() : '-';
    }
}
