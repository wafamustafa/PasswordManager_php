<?php
//File created by Wafa, Amanda, Elle, Barbara 03/2021
namespace Codesses\php\Models
{

use PDOException;

    class DatabaseTwo {

        // These variables must be set to the specific database connection information.
        private static $dbName = "tavl0054_pmWafadb";
        private static $host = "142.4.196.160:3306";
        private static $userName = "tavl0054_hostWafa";
        private static $password = "Humberphp123";

        // Private variables to interact with the database.
        private static $dataSourceName;
        private static $dbconnection;
    
        // Static class.
        private function __construct()
        {        
        }
        
        // Construct the PDO if required, then return PDO.
        public static function getDb()
        {
            if( self::$dbconnection == null ) {
                self::$dataSourceName  = "mysql:host=" .self::$host . ";dbname=" . self::$dbName;
    
                try {
                // Establish the connection.
                self::$dbconnection = new \PDO( self::$dataSourceName, self::$userName, self::$password );

                // Set some connection attributes.
                self::$dbconnection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

                } catch( PDOException $e ) {
                    echo $e->getMessage()();
                    exit();
                }

            }
            return self::$dbconnection;
        }
    }

}