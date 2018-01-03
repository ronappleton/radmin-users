<?php

return [
    "user_model" => 'App\User',

    "layout_file" => 'radmin::layouts.master',

    "super_user_name" => 'SuperAdmin',

    "resource_controller" => 'RonAppleton\Radmin\Users\Http\Controllers\ResourceController',

    "user_controller" => 'RonAppleton\Radmin\Users\Http\Controllers\UsersController',
];