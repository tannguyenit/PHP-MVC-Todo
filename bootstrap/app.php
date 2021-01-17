<?php

use App\App\App;
use App\App\Database\{QueryBuilder, Connection};

require 'vendor/autoload.php';
require 'utils/view.php';
require 'utils/http-response.php';
require 'utils/config.php';

if (config('app.debug')) {
    require 'utils/dd.php';
}

App::bind(
    'db',
    new QueryBuilder(Connection::make(config('database')))
);
