<?php


class Database{

	protected $url;
	protected $user;
	protected $pass;
	protected $db;
	protected $connection = null;

	
	public function __construct($url,$user,$pass,$db){
        $this->url = $url;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
    }

    public function __destruct() {
        if ($this->connection != null) {
            $this->closeConnection();
        }
    }

    protected function makeConnection(){
        $this->connection = new mysqli($this->url,$this->user,$this->pass,$this->db);
        if ($this->connection->connect_error) {
            echo "FAIL:" . $this->connection->connect_error;
        }
    }

    protected function closeConnection() {
        if ($this->connection != null) {
            $this->connection->close();
            $this->connection = null;
        }
    }

    protected function cleanParameters($p) {
        return $this->connection->real_escape_string($p);
    }
    
    public function executeQuery($q, $params = null){
        $this->makeConnection();        
        if ($params != null) {
            $queryParts = preg_split("/\?/", $q);
            if (count($queryParts) != count($params) + 1) {
                return false;
            }
            $finalQuery = $queryParts[0];
            for ($i = 0; $i < count($params); $i++) {
                $finalQuery = $finalQuery . $this->cleanParameters($params[$i]) . $queryParts[$i + 1];
            }
            $q = $finalQuery;
        }
        $result = $this->connection->query($q);
        return $result;
    }


}
?>