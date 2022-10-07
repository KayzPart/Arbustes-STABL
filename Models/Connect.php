<?php
    abstract class Connect{
        private static $_db;
    
        protected function getDb(){
            if(self::$_db === null){
                self::setDb();
            }
            return self::$_db;
        }
    
        private static function setDb(){
            try {
                self::$_db = new PDO("mysql:host=localhost;dbname=stage;charset=UTF8", 'root', '');
            } catch (PDOException $e) {
                echo 'Erreur de connection' . '<br>' . $e->getMessage();
            }
        }
    }