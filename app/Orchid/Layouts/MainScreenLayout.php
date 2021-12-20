<?php

namespace App\Orchid\Layouts;

use App\Models\User;
use Orchid\Icons\Icon;
use Orchid\Icons\IconComponent;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MainScreenLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'users';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', __('admin.statistics.username'))
                ->render(function (User $user) {
                    return $user->name;
                }),

            TD::make('totalTime', __('admin.statistics.totalaTime'))
                ->render(function (User $user) {
                    return $user->getTotalAttribute();
                }),

            TD::make('eventTime', __('admin.statistics.eventTime'))
                ->render(function (User $user) {
                    return $user->getEventTimeAttribute();
                }),

            TD::make('status', __('admin.statistics.status'))
                ->render(function (User $user) {
                    return CheckBox::make('is_active')
                        ->checked((bool)$user->status_id)
                        ->disabled(true)
                        ->sendTrueOrFalse();
                    ;
                }),

            TD::make('action', __('admin.main.action'))
                ->render(function (User $user) {
                    return $user->status_id
                        ? Button::make(__('admin.statistics.banUser'))
                                ->icon('ban')
                                ->method('banUser')
                                ->parameters(['id' => $user->id])
                        : Button::make(__('admin.statistics.unBanUser'))
                            ->icon('check')
                            ->method('unBanUser')
                            ->parameters(['id' => $user->id]);
                }),
        ];
    }
}
