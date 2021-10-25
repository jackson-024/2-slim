<?php

    class db{
        private $dbHost = '127.0.0.1';
        private $user = 'slim';
        private $dbpass = 'jeff1234';
        private $dbname = 'slim';

        //connect to db
        public function connect() {
            $mysql_connect_str = "mysql:host=$this->dbHost; dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->user, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $dbConnection;
        }
    }