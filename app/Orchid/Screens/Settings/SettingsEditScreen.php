<?php

namespace App\Orchid\Screens\Settings;

use App\Models\Setting;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SettingsEditScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Setting $setting): array
    {
        $this->exists = $setting->exists;

        $this->exists ? $this->name = __('admin.settings.edit') : $this->name = __('admin.settings.create') ;

        return [
            'setting' => $setting
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
            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Create')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
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
            Layout::rows([
                Input::make('setting.title')
                    ->title(__('admin.setting.title'))
                    ->placeholder(__('admin.setting.title_placeholder')),

                TextArea::make('setting.description')
                    ->title(__('admin.setting.description'))
                    ->rows(5)
                    ->maxlength(200)
                    ->placeholder(__('admin.setting.description_placeholder')),

                Input::make('setting.iframe_link')
                    ->title(__('admin.setting.iframe_link'))
                    ->placeholder(__('admin.setting.iframe_link_placeholder')),

                DateTimer::make('setting.start_time')
                    ->title(__('admin.setting.start_time'))
                    ->enableTime()
                    ->format24hr(),

                DateTimer::make('setting.end_time')
                    ->title(__('admin.setting.end_time'))
                    ->enableTime()
                    ->format24hr(),
            ])
        ];
    }

    public function createOrUpdate(Setting $setting, Request $request)
    {
        $setting->fill($request->get('setting'))->save();
        Alert::success(__('admin.settings.success'));

        return redirect()->route('platform.settings');
    }
}
