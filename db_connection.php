<?php

class DB_Connect
{

    public function connect()
    {
        try {
            $host = "us-cdbr-east-05.cleardb.net";
            $db = "heroku_ce2aaaeb2f2fe3c";
            $username = "b4505c2a49ed16";
            $password = "51e5c749";

            $host2 = "sql6.freemysqlhosting.net";
            $db2 = "sql6501826";
            $username2 = "sql6501826";
            $password2 = "YnaPNqTYI4";

            $active_group = 'default';
            $query_builder = TRUE;

            $conn = new PDO('mysql:host='. $host2 . '; dbname=' . $db2 , $username2, $password2);

            return $conn;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}
