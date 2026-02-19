<?php

return [
    App\Providers\AppServiceProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Module Service Providers
    |--------------------------------------------------------------------------
    */
    \Modules\Auth\Providers\AuthServiceProvider::class,
    \Modules\UserManagement\Providers\UserManagementServiceProvider::class,
];
