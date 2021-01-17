<?php


namespace App\Tests;

use App\App\App;
use \PDO;
use App\App\Database\{QueryBuilder, Connection};
use PHPUnit\Framework\TestCase as PHPUnit;

class TestCase extends PHPUnit
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setUp(): void
    {
        parent::setUp();

        $dbConfig = require __DIR__ . '/../config/database.php';
        require __DIR__ . '/../utils/http-response.php';

        App::bind(
            'db',
            new QueryBuilder(Connection::make($dbConfig))
        );

    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
