<?php

namespace App\Orchid\Screens\Rooms;

use App\Models\Material;
use App\Models\Partner;
use App\Models\Room;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class RoomsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'RoomsEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Room $room): array
    {
        $this->exists = $room->exists;

        $this->exists ? $this->name = __('admin.rooms.edit') : $this->name = __('admin.rooms.create') ;

        $room->load('attachment');

        return [
            'room' => $room
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
                Input::make('room.title')
                    ->title(__('admin.rooms.title'))
                    ->placeholder(__('admin.rooms.title_placeholder')),

                TextArea::make('room.about')
                    ->title(__('admin.rooms.about'))
                    ->rows(5)
                    ->maxlength(200)
                    ->placeholder(__('admin.rooms.description_placeholder')),

                Input::make('room.link')
                    ->title(__('admin.rooms.link')),

                Input::make('room.order')
                    ->type('number')
                    ->title(__('admin.rooms.order')),

                Relation::make('room.partner_id')
                    ->title(__('admin.rooms.partner'))
                    ->fromModel(Partner::class, 'title'),

                Cropper::make('room.image_id')
                    ->title(__('admin.rooms.image_id'))
                    ->targetId()

            ])
        ];
    }

    public function createOrUpdate(Room $room, Request $request)
    {
        $room->fill($request->get('room'))->save();
        Alert::success(__('admin.rooms.success'));

        return redirect()->route('platform.rooms.list');
    }

    public function remove(Room $room)
    {
        $room->delete();
        Alert::success(__('admin.rooms.success_deleted'));

        return redirect()->route('platform.rooms.list');
    }
}
