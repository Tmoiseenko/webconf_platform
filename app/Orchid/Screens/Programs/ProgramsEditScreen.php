<?php

namespace App\Orchid\Screens\Programs;

use App\Models\Partner;
use App\Models\Program;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProgramsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ProgramsEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Program $program): array
    {
        $this->exists = $program->exists;

        $this->exists ? $this->name = __('admin.programs.edit') : $this->name = __('admin.programs.create') ;

        $program->load('attachment');

        return [
            'program' => $program
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
            Button::make('Save')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Create')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
                Input::make('program.author')
                    ->title(__('admin.programs.title'))
                    ->placeholder(__('admin.programs.title_placeholder')),

                TextArea::make('program.topic')
                    ->title(__('admin.programs.about'))
                    ->rows(5)
                    ->maxlength(200)
                    ->placeholder(__('admin.programs.about_placeholder')),

                CheckBox::make('program.vip')
                    ->title(__('admin.programs.vip'))
                    ->sendTrueOrFalse(),

                DateTimer::make('program.started_at')
                    ->title(__('admin.programs.started_at'))
                    ->format24hr()
                    ->noCalendar()
                    ->enableTime()
                    ,

                DateTimer::make('program.finished_at')
                    ->title(__('admin.programs.started_at'))
                    ->format24hr()
                    ->noCalendar()
                    ->enableTime()
                        ,
                Cropper::make('program.image_id')
                    ->title(__('admin.programs.image_id'))
                    ->targetId()

            ])
        ];
    }

    public function createOrUpdate(Program $program, Request $request)
    {
        $program->fill($request->get('program'))->save();
        Alert::success(__('admin.programs.success'));

        return redirect()->route('platform.programs.list');
    }

    public function remove(Program $program)
    {
        $program->delete();
        Alert::success(__('admin.programs.success_deleted'));

        return redirect()->route('platform.programs.list');
    }
}
