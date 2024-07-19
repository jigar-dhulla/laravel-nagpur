<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('tasks-purged', function ($user) {
    return $user->can('purge-tasks');
});

Broadcast::channel('active-users', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});
