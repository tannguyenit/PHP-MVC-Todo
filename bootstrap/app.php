<?php

use App\App\App;
use App\App\Database\{QueryBuilder, Connection};

require_once 'vendor/autoload.php';
require_once 'utils/view.php';
require_once 'utils/http-response.php';
require_once 'utils/config.php';
require_once 'infrastructure/DotEnv/DotEnv.php';
require_once 'utils/helpers.php';

if (config('app.debug')) {
    require 'utils/dd.php';
}

App::bind(
    'db',
    new QueryBuilder((new Connection())->make(config('database')))
);
