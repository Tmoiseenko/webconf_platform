<?php

namespace App\Orchid\Layouts\Programs;

use App\Models\Partner;
use App\Models\Program;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProgramsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'programs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->width('150')
                ->render(function (Program $program) {
                    $html = '';
                    if ($program->image) {
                        $html = "<img src='{$program->image->getRelativeUrlAttribute()}'
                              alt='{$program->image->getTitleAttribute()}'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$program->id}</span>";
                    } else {
                        $html = "<span class='small text-muted mt-1 mb-0'># {$program->id}</span>";
                    }
                    return $html;
                }),
            TD::make('title', __('admin.main.title'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Program $program) {
                    return $program->author;
                }),
            TD::make('title', __('admin.main.start_time'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Program $program) {
                    return Carbon::parse($program->started_at)->format('H:i');
                }),
            TD::make('title', __('admin.main.end_time'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Program $program) {
                    return Carbon::parse($program->finished_at)->format('H:i');
                }),
            TD::make('action', __('admin.main.action'))
                ->align(TD::ALIGN_RIGHT)
                ->render(function (Program $program) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.program.edit', $program)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->method('remove')
                                ->icon('trash')
                                ->confirm(__('delete_item', ['item' => __('admin.programs.item')]))
                                ->parameters([
                                    'id' => $program->id,
                                ]),
                        ]);
                })
        ];
    }
}
