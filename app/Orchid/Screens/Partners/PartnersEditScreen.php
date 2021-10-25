<?php

namespace App\Orchid\Screens\Partners;

use App\Models\Partner;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class PartnersEditScreen extends Screen
{

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Partner $partner): array
    {
        $this->exists = $partner->exists;

        $this->exists ? $this->name = __('admin.partners.edit') : $this->name = __('admin.partners.create') ;

        $partner->load('attachment');

        return [
            'partner' => $partner
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
                Input::make('partner.title')
                    ->title(__('admin.partners.title'))
                    ->placeholder(__('admin.partners.title_placeholder')),

                TextArea::make('partner.about')
                    ->title(__('admin.partners.about'))
                    ->rows(5)
                    ->maxlength(200)
                    ->placeholder(__('admin.partners.about_placeholder')),

                Input::make('partner.link')
                    ->title(__('admin.partners.link'))
                    ->placeholder(__('admin.partners.link_placeholder')),

                Picture::make('partner.image_id')
                    ->title(__('admin.partners.image_id'))
                    ->targetId()

            ])
        ];
    }

    public function createOrUpdate(Partner $partner, Request $request)
    {
        $partner->fill($request->get('partner'))->save();
        Alert::success(__('admin.partners.success'));

        return redirect()->route('platform.partners.list');
    }

    public function remove(Partner $partner)
    {
        $partner->delete();
        Alert::success(__('admin.partners.success_deleted'));

        return redirect()->route('platform.partners.list');
    }

}
