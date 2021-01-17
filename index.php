<?php

require 'bootstrap/app.php';
use App\App\{Router, Request};

Router::load('routes/web.php')->direct(Request::uri(), Request::method());
