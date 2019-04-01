<?php declare(strict_types=1);

class Database
{
    static private $host = 'localhost';
    static private $username = "root";
    static private $password = "";
    static private $dbname = "service_me";
    static private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true, //Keep the connection cached
        PDO::ATTR_EMULATE_PREPARES => false // Real prepared statements
    );
    static private $connection;

    /**
     * Database constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return PDO
     */
    public static function get_connection(): PDO
    {
        if (is_null(Database::$connection) or !is_resource(Database::$connection)) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname;
            try {
                self::$connection = new PDO($dsn, Database::$username, Database::$password, Database::$options);
            } catch (PDOException $e) {
                echo 'Error connecting to database';
            }
        }
        return self::$connection;

    }

    public static function close_connection()
    {
        self::$connection = null;
    }


}


