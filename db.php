<?php

require_once('config.php');
/*
 * Database settings
 */


try {
    $db = new PDO("mysql:host=" . FDB_SERVER . ";dbname=" . FDB_NAME, FDB_USERNAME, FDB_PASSWORD);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    exit();
}
