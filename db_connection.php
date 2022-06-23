<?php

class DB_Connect {

    public function connect() {
        try {
            $username = "b4505c2a49ed16";
            $password = "51e5c749";
            $conn = new PDO('mysql:host=mysql://b4505c2a49ed16:51e5c749@us-cdbr-east-05.cleardb.net; dbname=heroku_ce2aaaeb2f2fe3c', $username, $password);

            return $conn;
        }
        catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}