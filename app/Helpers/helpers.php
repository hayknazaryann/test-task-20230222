<?php

use App\Models\User;

if (! function_exists('user_is_logged_in')) {
    function user_is_logged_in(): bool
    {
        return auth()->guard('web')->check();
    }
}

if (! function_exists('current_user')) {
    function current_user()
    {
        return user_is_logged_in()
            ? User::find(auth()->id())->load(['tokens', 'jsonData'])
            : null;
    }
}

if (! function_exists('generate_uuid')) {
    function generate_uuid() {
        $count = \App\Models\JsonData::count(); $count++;
        $uuid = 'd' . $count . '-' . \Illuminate\Support\Str::random(10);
        return $uuid;
    }
}
