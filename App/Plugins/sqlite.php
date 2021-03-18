<?php 



class sqlite{

	protected $db;
	protected $sql;


	public function __construct($joylashuv){
		$this->db = new PDO('sqlite:'.$joylashuv);
		$this->sql = new SQLite3($joylashuv);
	}


	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_int($val)) {
					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function onerow($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetch(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []) {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

    public function autoCount($tableName, $params=[]){
        $result = $this->query("SELECT count(*) FROM $tableName", $params);
		return $result->fetchColumn();
    }

    
}
