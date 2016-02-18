<?php

return [
    # common
    'logout' => 'site/logout',
    'login' => 'site/login',
    'signup' => 'site/signup',

    # posts related
    'topics' => 'post/index',
    'topics/<categoryAlias>' => 'post/by-category',
    'topics/<categoryAlias>/<postAlias>' => 'post/view',
    'search' => 'post/search',

    # management
    'management' => 'management/dashboard',
    'management/users' => 'management/user/index',
];
