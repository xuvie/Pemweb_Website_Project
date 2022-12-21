<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    
    return new PDO("mysql:host=$host; dbname=pemweb", $username, $password);
?>