<?php

$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'pgsql:host=app_database_test;dbname=' . $_ENV['DB_NAME'];

return $db;
