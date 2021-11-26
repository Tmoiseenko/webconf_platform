<?php

namespace App\Orchid\Screens\Materials;

use App\Models\Material;
use App\Models\Partner;
use App\Models\Setting;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MaterialsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'MaterialsEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Material $material): array
    {
        $this->exists = $material->exists;

        $this->exists ? $this->name = __('admin.materials.edit') : $this->name = __('admin.materials.create') ;

        $material->load('attachment');

        return [
            'material' => $material
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
                Input::make('material.title')
                    ->title(__('admin.materials.title'))
                    ->placeholder(__('admin.materials.title_placeholder')),

                TextArea::make('material.about')
                    ->title(__('admin.materials.about'))
                    ->rows(5)
                    ->maxlength(200)
                    ->placeholder(__('admin.materials.description_placeholder')),

                Input::make('material.link')
                    ->title(__('admin.materials.link')),

                Input::make('material.order')
                    ->type('number')
                    ->title(__('admin.materials.order')),

                Relation::make('material.partner_id')
                    ->title(__('admin.materials.partner'))
                    ->fromModel(Partner::class, 'title'),

                Cropper::make('material.image_id')
                    ->title(__('admin.materials.image_id'))
                    ->targetId()

            ])
        ];
    }

    public function createOrUpdate(Material $material, Request $request)
    {
        $material->fill($request->get('material'))->save();
        Alert::success(__('admin.materials.success'));

        return redirect()->route('platform.materials.list');
    }

    public function remove(Material $material)
    {
        $material->delete();
        Alert::success(__('admin.materials.success_deleted'));

        return redirect()->route('platform.materials.list');
    }
}
