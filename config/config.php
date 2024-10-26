<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'videogame_db';

function db_connect() {
    global $db_host, $db_user, $db_pass, $db_name;
    return new mysqli($db_host, $db_user, $db_pass, $db_name);
}