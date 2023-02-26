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

if (! function_exists('generate_code')) {
    function generate_code() {
        $count = \App\Models\JsonData::count(); $count++;
        $code = 'd' . $count . '-' . \Illuminate\Support\Str::random(10);
        return $code;
    }
}
if (! function_exists('get_hierarchy')) {
    function get_hierarchy($data) {
        $hierarchy = '';
        if (!is_null($data) && !empty($data)) {
            get_rows($hierarchy, $data);
        }
        return $hierarchy;
    }
}

if (! function_exists('get_rows')) {
    function get_rows(&$hierarchy, $data) {

        foreach ($data as $key => $item) {
            if (is_array($item)) {
                $hierarchy .=  '<li class="list-group-item">' . '<a href="javascript:void(0)" class="show-item">'.ucfirst($key).'</a>' .'<ul class="hide list-group">';
                get_rows($hierarchy, $item);
                $hierarchy .= '</ul></li>';
            } else {
                $row = '<li class="list-group-item">' . $item . '</li>';
                $hierarchy.= $row;
            }

        }
    }
}
