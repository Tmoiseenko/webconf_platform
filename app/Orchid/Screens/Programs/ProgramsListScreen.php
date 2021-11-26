<?php

namespace App\Orchid\Screens\Programs;

use App\Models\Program;
use App\Orchid\Layouts\Programs\ProgramsListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ProgramsListScreen extends Screen
{
    public function __construct()
    {
        $this->name = __('admin.programs.panel_name');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'programs' => Program::paginate()
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
                ->route('platform.program.edit'),
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
            ProgramsListLayout::class
        ];
    }

    public function remove($id)
    {
        Program::where('id', $id)->delete();
        Alert::success(__('admin.programs.success_deleted'));

        return redirect()->route('platform.programs.list');
    }
}
