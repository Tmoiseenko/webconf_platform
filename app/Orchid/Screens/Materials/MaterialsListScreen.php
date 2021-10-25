<?php

namespace App\Orchid\Screens\Materials;

use App\Models\Material;
use App\Orchid\Layouts\Materials\MaterialsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class MaterialsListScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.materials.panel_name');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'materials' => Material::paginate()
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
                ->route('platform.materials.edit'),
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
            MaterialsListLayout::class
        ];
    }

    public function remove($id)
    {
        Material::where('id', $id)->delete();
        Alert::success(__('admin.partners.success_deleted'));

        return redirect()->route('platform.materials.list');
    }
}
