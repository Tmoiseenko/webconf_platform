<?php

namespace App\Orchid\Layouts\Materials;

use App\Models\Material;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MaterialsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'materials';

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
                ->render(function (Material $material) {
                    $html = '';
                    if ($material->image) {
                        $html = "<img src='{$material->image->getRelativeUrlAttribute()}'
                              alt='{$material->image->getTitleAttribute()}'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$material->id}</span>";
                    } else {
                        $html = "<span class='small text-muted mt-1 mb-0'># {$material->id}</span>";
                    }
                    return $html;
                }),
            TD::make('title', __('admin.main.title'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Material $material) {
                    return $material->title;
                }),
            TD::make('title', __('admin.materials.order'))
                ->align(TD::ALIGN_CENTER)
                ->render(function (Material $material) {
                    return $material->order;
                }),
            TD::make('action', __('admin.main.action'))
                ->align(TD::ALIGN_RIGHT)
                ->render(function (Material $material) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.materials.edit', $material)
                                ->icon('pencil'),
                            Button::make(__('Delete'))
                                ->method('remove')
                                ->icon('trash')
                                ->confirm(__('delete_item', ['item' => __('admin.materials.item')]))
                                ->parameters([
                                    'id' => $material->id,
                                ]),
                        ]);
                })
        ];
    }
}
