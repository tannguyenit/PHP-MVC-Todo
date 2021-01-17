<?php

return [
  'dbname' => 'todo',
  'username' => 'root',
  'password' => '123',
  'driver' => 'mysql',
  'host' => 'database',
  'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ],
];
