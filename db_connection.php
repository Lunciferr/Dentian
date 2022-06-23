<?php

class DB_Connect
{

    public function connect()
    {
        try {
            $username = "b4505c2a49ed16";
            $password = "51e5c749";
            $active_group = 'default';
            $query_builder = TRUE;
            
            $conn = new PDO('mysql:host=us-cdbr-east-05.cleardb.net; dbname=heroku_ce2aaaeb2f2fe3c', $username, $password);

            return $conn;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}
