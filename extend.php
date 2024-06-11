<?php

/*
 * This file is part of blomstra/save-sorting-preferences.
 *
 * Copyright (c) 2024 Jaggy Gauran.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\SaveSortingPreferences;

use Blomstra\SaveSortingPreferences\ShowUserPreferredSortingController;
use Flarum\Extend;

return [
    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Routes('api'))
        ->get('/sorting-preference', 'sorting-preferences.show', ShowUserPreferredSortingController::class),

    (new Extend\Middleware('forum'))->add(ApplyUserSortingMiddleware::class),

    (new Extend\Middleware('api'))->add(ApplyUserSortingMiddleware::class),

    (new Extend\User)->registerPreference('discussion_sort'),


    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
];
