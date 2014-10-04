<?php
/* The code is from a tutorial on PHP CRUD found on: http://www.startutorial.com/articles/view/php-crud-tutorial-part-1
 * Create a PHP file "database.php"; this file contains a PHP class named "Database". Throughout this application, 
 * Database handles all the stuff related to database connections, such as connecting and disconnecting. 
 * The code is using PDO for database access.
 */
?>
<?php

class Database
{
    private static $dbName = 'Aprov' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'mestringisystem';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>