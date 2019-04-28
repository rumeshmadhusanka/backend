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

    public static function run($sql, $bind = array())
    {
        $sql = trim($sql);

        try {
            $result = Database::get_connection()->prepare($sql);
            $result->execute($bind);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit(1);
        }
    }

    public static function read($table, $where = "", $bind = array(), $fields = "*"){
        $sql = "SELECT " . $fields . " FROM " . $table;
        if (!empty($where))
            $sql .= " WHERE " . $where;
        $sql .= ";";
        $result = Database::run($sql, $bind);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $rows = array();
        while ($row = $result->fetch()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public static function update($table, $data, $where, $bind = array()){
        $fields = Database::filter($table, $data);
        $fieldSize = sizeof($fields);
        $sql = "UPDATE " . $table . " SET ";
        for ($f = 0; $f < $fieldSize; ++$f) {
            if ($f > 0)
                $sql .= ", ";
            $sql .= $fields[$f] . " = :update_" . $fields[$f];
        }
        $sql .= " WHERE " . $where . ";";
        foreach ($fields as $field)
            $bind[":update_$field"] = $data[$field];

        $result = Database::run($sql, $bind);
        return $result->rowCount();
    }

    public static function delete($table, $where, $bind = ""){
        $sql = "DELETE FROM " . $table . " WHERE " . $where . ";";
        $result = Database::run($sql, $bind);
        return $result->rowCount();
    }
    public static function insert($table,$columns ,$values):bool{
        $sql="INSERT INTO ".$table." (";
        $sql.=implode(",",$columns);
        $sql .= ") VALUES (";
        $places=array();
        //create placeholders
        foreach ($columns as $val){
            $places[]="?";
        }
        $sql.= implode(',',$places);
        $sql.=")";
        try{
        Database::run($sql,$values);
        }catch (Exception $e){
            return false;
        }
        return true;
    }

    private static function filter($table, $data){
        $sql = "DESCRIBE " . $table . ";";
        $key = "Field";
        if (false !== ($list = Database::run($sql))) {
            $fields = array();
            foreach ($list as $record)
                $fields[] = $record[$key];
            return array_values(array_intersect($fields, array_keys($data)));
        }
        return array();
    }

}

