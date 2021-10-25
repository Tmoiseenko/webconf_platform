<?php

namespace App\Orchid\Screens\Partners;

use App\Models\Partner;
use App\Orchid\Layouts\Partners\PartnersListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class PartnersListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PartnersListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'partners' => Partner::paginate()
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
                ->route('platform.partners.edit'),
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
            PartnersListLayout::class
        ];
    }

    public function remove($id)
    {
        Partner::where('id', $id)->delete();
        Alert::success(__('admin.partners.success_deleted'));

        return redirect()->route('platform.partners.list');
    }
}
