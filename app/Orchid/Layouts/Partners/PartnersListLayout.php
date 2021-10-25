<?php

namespace App\Orchid\Layouts\Partners;

use App\Models\Material;
use App\Models\Partner;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PartnersListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'partners';

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
                ->render(function (Partner $partner) {
                    return "<img src='{$partner->image->getRelativeUrlAttribute()}'
                              alt='{$partner->image->getTitleAttribute()}'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$partner->id}</span>";
                }),
            TD::make('title', __('Title'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Partner $partner) {
                    return $partner->title;
                }),
            TD::make('action', __('Action'))
                ->align(TD::ALIGN_RIGHT)
                ->render(function (Partner $partner) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.partners.edit', $partner)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->method('remove')
                                ->icon('trash')
                                ->confirm(__('delete_item', ['item' => __('admin.partners.item')]))
                                ->parameters([
                                    'id' => $partner->id,
                                ]),
                        ]);
                })
        ];
    }
}
