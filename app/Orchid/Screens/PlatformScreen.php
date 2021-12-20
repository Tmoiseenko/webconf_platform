<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Events\BanEvent;
use App\Models\User;
use App\Orchid\Layouts\MainScreenLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class PlatformScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.main.title');
        $this->description = __('admin.main.description');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'users' => User::with('statistics')->get()
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
            Button::make(__('admin.statistics.download'))
                ->icon('share-alt')
                ->method('exportUsers')
                ->rawClick()
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            MainScreenLayout::class
        ];
    }

    public function exportUsers()
    {
        $users = User::with('statistics')->get();
        $columns = ['Имя', 'Компания', 'Должность', 'Телефон', 'Email', 'Время с момента регистрации',  'Проведенное время в момент трансляции'];
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=users.csv',
        ];

        $callback = function () use ($users, $columns) {
            $stream = fopen('php://output', 'w');
            fputcsv($stream, $columns);

            foreach ($users as $user) {
                fputcsv($stream, [
                    'Имя' => $user->name,
                    'Компания' => $user->company,
                    'Должность' => $user->position,
                    'Телефон' => $user->phone,
                    'Email' => $user->email,
                    'Время с момента регистрации' => $user->getTotalAttribute(),
                    'Проведенное время в момент трансляции' => $user->getEventTimeAttribute()
                ]);
            }

            fclose($stream);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function banUser($id)
    {
        $user = User::find($id);
        $user->update(['status_id' => 0]);

        event(new BanEvent($user));

        Alert::error(__('admin.main.banUserMessage', ['name' => $user->name]));
    }

    public function unBanUser($id)
    {
        $user = User::find($id);
        $user->update(['status_id' => 1]);

        event(new BanEvent($user));

        Alert::success(__('admin.main.unBanUserMessage', ['name' => $user->name]));
    }
}
