<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make(__('admin.main.menu_title'))
                ->icon('graph')
                ->route('platform.main')
                ->permission('platform.systems.manager'),

            Menu::make(__('admin.settings.menu_title'))
                ->icon('event')
                ->route('platform.settings')
                ->permission('platform.systems.manager'),

            Menu::make(__('admin.partners.menu_title'))
                ->icon('organization')
                ->route('platform.partners.list')
                ->permission('platform.systems.manager'),

            Menu::make(__('admin.materials.menu_title'))
                ->icon('docs')
                ->route('platform.materials.list')
                ->permission('platform.systems.manager'),

            Menu::make(__('admin.rooms.menu_title'))
                ->icon('screen-desktop')
                ->route('platform.rooms.list')
                ->permission('platform.systems.manager'),

            Menu::make(__('admin.programs.menu_title'))
                ->icon('task')
                ->route('platform.programs.list')
                ->permission('platform.systems.manager'),

            Menu::make(__('admin.mails.menu_title'))
                ->icon('envelope')
                ->route('platform.mails.list')
                ->permission('platform.systems.manager'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.manager', __('admin.permission.manager'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.user', __('admin.permissions.user')),
        ];
    }
}
