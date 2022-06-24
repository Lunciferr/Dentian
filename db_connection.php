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
            $db2 = "sql6501622";
            $username2 = "sql6501622";
            $password2 = "bKFKRjTEB9";

            $host3 = "databases-auth.000webhost.com";
            $db3 = "id19160125_dentian";
            $username3 = "id19160125_dentian_admin";
            $password3 = 'BC$?t*ve|b#AW8\A$u';

            $active_group = 'default';
            $query_builder = TRUE;

            $conn = new PDO('mysql:host='. $host3 . '; dbname=' . $db3 , $username3, $password3);

            return $conn;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br>";
            die();
        }
    }
}
