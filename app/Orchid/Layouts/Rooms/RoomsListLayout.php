<?php

namespace App\Orchid\Layouts\Rooms;

use App\Models\Material;
use App\Models\Room;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RoomsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'rooms';

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
                ->render(function (Room $rooms) {
                    $html = '';
                    if ($rooms->image) {
                        $html = "<img src='{$rooms->image->getRelativeUrlAttribute()}'
                              alt='{$rooms->image->getTitleAttribute()}'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$rooms->id}</span>";
                    } else {
                        $html = "<span class='small text-muted mt-1 mb-0'># {$rooms->id}</span>";
                    }
                    return $html;
                }),
            TD::make('title', __('admin.main.title'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Room $rooms) {
                    return $rooms->title;
                }),
            TD::make('title', __('admin.rooms.order'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Room $rooms) {
                    return $rooms->order;
                }),
            TD::make('action', __('admin.main.action'))
                ->align(TD::ALIGN_RIGHT)
                ->render(function (Room $rooms) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.room.edit', $rooms)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->method('remove')
                                ->icon('trash')
                                ->confirm(__('delete_item', ['item' => __('admin.rooms.item')]))
                                ->parameters([
                                    'id' => $rooms->id,
                                ]),
                        ]);
                })
        ];
    }
}
