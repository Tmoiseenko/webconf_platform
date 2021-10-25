<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Setting;
use App\Orchid\Layouts\Settings\SettingsListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SettingsListScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.settings.index');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $settings = Setting::all();
        $this->count = $settings->count();

        return [
            'setting' => $settings
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create')
                ->icon('pencil')
                ->route('platform.settings.create')
                ->canSee(!$this->count),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            SettingsListLayout::class
        ];
    }
}
