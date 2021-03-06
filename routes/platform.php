<?php

declare(strict_types=1);

use App\Orchid\Screens\Materials\MaterialsEditScreen;
use App\Orchid\Screens\Materials\MaterialsListScreen;
use App\Orchid\Screens\Partners\PartnersEditScreen;
use App\Orchid\Screens\Partners\PartnersListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Programs\ProgramsEditScreen;
use App\Orchid\Screens\Programs\ProgramsListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Rooms\RoomsEditScreen;
use App\Orchid\Screens\Rooms\RoomsListScreen;
use App\Orchid\Screens\Settings\SettingsEditScreen;
use App\Orchid\Screens\Settings\SettingsListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Settings
Route::screen('settings', SettingsListScreen::class)
    ->name('platform.settings')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.settings.menu_title'), route('platform.settings'));
    });


Route::screen('settings/{setting?}/edit', SettingsEditScreen::class)
    ->name('platform.settings.edit')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.settings.edit'), route('platform.settings.edit'));
    });

Route::screen('settings/create', SettingsEditScreen::class)
    ->name('platform.settings.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.settings.create'), route('platform.settings.create'));
    });


// Platform > Materials
Route::screen('material/{material?}', MaterialsEditScreen::class)
    ->name('platform.materials.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.materials.list')
            ->push(__('admin.materials.edit_banner'));
    });
Route::screen('materials', MaterialsListScreen::class)
    ->name('platform.materials.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.materials.panel_name'), route('platform.materials.list'));
    });

// Platform > Rooms
Route::screen('room/{room?}', RoomsEditScreen::class)
    ->name('platform.room.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.rooms.list')
            ->push(__('admin.rooms.edit_banner'));
    });
Route::screen('rooms', RoomsListScreen::class)
    ->name('platform.rooms.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.rooms.panel_name'), route('platform.rooms.list'));
    });

// Platform > Partners
Route::screen('partner/{partner?}', PartnersEditScreen::class)
    ->name('platform.partners.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.partners.list')
            ->push(__('admin.partners.edit_banner'));
    });
Route::screen('partners', PartnersListScreen::class)
    ->name('platform.partners.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.partners.panel_name'), route('platform.partners.list'));
    });


// Platform > Programs
Route::screen('program/{program?}', ProgramsEditScreen::class)
    ->name('platform.program.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.programs.list')
            ->push(__('admin.programs.edit_banner'));
    });
Route::screen('programs', ProgramsListScreen::class)
    ->name('platform.programs.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.programs.panel_name'), route('platform.programs.list'));
    });


Route::screen('mails', \App\Orchid\Screens\MailsSender::class)
    ->name('platform.mails.list')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.mails.panel_name'), route('platform.mails.list'));
    });

