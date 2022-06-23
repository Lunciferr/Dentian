<?php

class DB_Connect {

    public function connect() {
        try {
            $username = "root";
            $password = "";
            $conn = new PDO('mysql:host=localhost; dbname=fyp', $username, $password);

            return $conn;
        }
        catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}