<?php

namespace App\Orchid\Screens\Rooms;

use App\Models\Material;
use App\Models\Room;
use App\Orchid\Layouts\Rooms\RoomsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class RoomsListScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.rooms.panel_name');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'rooms' => Room::orderBy('order', 'asc')->paginate()
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
                ->route('platform.room.edit'),
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
            RoomsListLayout::class,
        ];
    }

    public function remove($id)
    {
        Room::where('id', $id)->delete();
        Alert::success(__('admin.rooms.success_deleted'));

        return redirect()->route('platform.rooms.list');
    }
}
