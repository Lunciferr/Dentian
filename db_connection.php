<?php

class DB_Connect
{

    public function connect()
    {
        try {
            $host = "us-cdbr-east-05.cleardb.net";
            $username = "b4505c2a49ed16";
            $password = "51e5c749";

            $anotherHost = "sql6.freemysqlhosting.net";
            $anotherUsername = "sql6501622";
            $anotherPassword = "bKFKRjTEB9";

            $active_group = 'default';
            $query_builder = TRUE;

            $conn = new PDO('mysql:host='. $anotherHost . '; dbname=heroku_ce2aaaeb2f2fe3c', $anotherUsername, $anotherPassword);

            return $conn;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}
