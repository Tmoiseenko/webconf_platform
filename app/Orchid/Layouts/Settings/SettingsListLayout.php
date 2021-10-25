<?php

namespace App\Orchid\Layouts\Settings;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SettingsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'setting';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('setting.title', __('Title'))
                ->render(function ($setting) {
                    return Link::make($setting->title)
                        ->route('platform.settings.edit', $setting);
                }),
            TD::make('setting.start_time', __('admin.settings.start_time'))
            ->render(function ($setting) {
                return $setting->start_time;
            }),
            TD::make('setting.end_time', __('admin.settings.end_time'))
            ->render(function ($setting) {
                return $setting->end_time;
            }),
        ];
    }
}
