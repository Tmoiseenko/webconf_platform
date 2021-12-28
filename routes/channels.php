<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::routes();

Broadcast::channel('chat', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('likes', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('hide', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});

Broadcast::channel('bans', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});

