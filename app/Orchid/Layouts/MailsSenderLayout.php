<?php

namespace App\Orchid\Layouts;

use App\Models\Material;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MailsSenderLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'mails';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title', __('admin.main.title'))
                ->align(TD::ALIGN_LEFT)
                ->render(function ($mail) {
                    return $mail['title'];
                }),

            TD::make('action', __('admin.main.action'))
                ->align(TD::ALIGN_RIGHT)
                ->render(function ($mail) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Button::make(__('admin.mails.buttonsSendAll'))
                                ->method('sendAll')
                                ->parameters([
                                    'mail' => $mail['slug'],
                                ]),
                            Button::make(__('admin.mails.buttonsSendTest'))
                                ->method('sendTest')
                                ->parameters([
                                    'mail' => $mail['slug'],
                                ]),
                        ]);
                })
        ];
    }
}
