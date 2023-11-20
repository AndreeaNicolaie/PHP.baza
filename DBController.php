<?php

class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "eveniment2";
    private static $conn;

    function __construct() {
        if (!self::$conn) {
            self::$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
    }

    public static function getConnection() {
        if (empty(self::$conn)) {
            new DBController();
        }
        return self::$conn;
    }

    function getDBResult($query, $params = array()) {
        $sql_statement = self::$conn->prepare($query);
        if ($sql_statement === false) {
            error_log("Prepare failed: " . self::$conn->error);
            return null;
        }

        if (!empty($params)) {
            $this->bindParams($sql_statement, $params);
        }

        $sql_statement->execute();
        $result = $sql_statement->get_result();

        $resultset = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        return $resultset;
    }

    function updateDB($query, $params = array()) {
        $sql_statement = self::$conn->prepare($query);
        if ($sql_statement === false) {
            error_log("Prepare failed: " . self::$conn->error);
            return null;
        }

        if (!empty($params)) {
            $this->bindParams($sql_statement, $params);
        }

        $sql_statement->execute();
    }

    function bindParams($sql_statement, $params) {
        $param_type = "";
        foreach ($params as $query_param) {
            $param_type .= $query_param["param_type"];
        }

        $bind_params = [];
        $bind_params[] = &$param_type;

        foreach ($params as $k => $query_param) {
            $bind_params[] = &$params[$k]["param_value"];
        }

        call_user_func_array([$sql_statement, 'bind_param'], $bind_params);
    }
}
?>
