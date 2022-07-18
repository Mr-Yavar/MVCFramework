<?php namespace System\Database\DBConnection;


class DBConnection{

    private static $dbConnectionInstance=null;

    private function __construct(){
        
    }

    public static function GetDBConnectionInstance(){
        if(self::$dbConnectionInstance == null)
            self::$dbConnectionInstance=(new DBConnection)->dbConnection();
        
        return self::$dbConnectionInstance;
    } 

    private function dbConnection(){
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
             return new \PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8mb4", DBUSERNAME,DBPASSWORD, $options);
        } catch (\PDOException $e) {
             echo "error is database connection : ".$e->getMessage();
             return false;
        }
    }

    public static function newInsertId(){
        return self::GetDBConnectionInstance()->lastInsertId();
    }
}