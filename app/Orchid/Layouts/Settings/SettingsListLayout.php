<?php

namespace App\Orchid\Layouts\Settings;

use App\Models\Room;
use App\Models\Setting;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
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
            TD::make('setting.title', __('admin.main.title'))
                ->render(function (Setting $setting) {
                    return $setting->title;
                }),
            TD::make('setting.start_time', __('admin.settings.start_time'))
            ->render(function (Setting $setting) {
                return $setting->start_time;
            }),
            TD::make('setting.end_time', __('admin.settings.end_time'))
            ->render(function (Setting $setting) {
                return $setting->end_time;
            }),

            TD::make('action', __('admin.main.action'))
                ->align(TD::ALIGN_RIGHT)
                ->render(function (Setting $setting) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.settings.edit', $setting)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->method('remove')
                                ->icon('trash')
                                ->confirm(__('delete_item', ['item' => __('admin.settings.item')]))
                                ->parameters([
                                    'id' => $setting->id,
                                ]),
                        ]);
                })
        ];
    }
}
