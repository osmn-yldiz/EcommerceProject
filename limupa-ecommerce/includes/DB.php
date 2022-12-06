<?php
	class DB{

    public $db;
    public $db_host;
    public $db_name;
    public $db_user;
    public $db_pass;    
    public $db_charset;    
    public $errors = array();
    public $stmt;
    public $debugIsEnabled=false;
    public $totalrows;

    public function __construct(){
    	//parent::__construct();
		//$this->connect->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		//$this->connect($db_host,$db_name,$db_user,$db_pass);
    }
    
    function connect($db_host,$db_name,$db_user,$db_pass,$optionArray=array()) {
    	//print "bağlandı.";
        $dsnStatement = 'mysql:host=' . $db_host . ';dbname=' . $db_name.';charset=utf8';

        if( empty($optionArray)){
            //default olarak utf8 set names çalışıyor her query de,
            //kalıcı (persistant) bağlantı açıyoruz.
            //error mode açık.
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_PERSISTENT    => FALSE,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY=>TRUE,
                PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
                
            );
        }else{
            $options = $optionArray;
        }


        try{
            $this->db = new PDO($dsnStatement, $db_user, $db_pass, $options);
        }
        catch(PDOException $e){
            $this->errors[] = $e->getMessage();
        }
        return $this->db; // This makes all the magic!!!
    }
    /**
     * [true gönderilirse PDOStatement Object 'i ekrana basar. queryString'i görmek için kullanabilirsiniz.]
     * @param [type] $isEnabled [description]
     */
    public function setDebugParam($isEnabled){
        $this->debugIsEnabled = $isEnabled;
    }

    public function query($sqlQuery){
        $this->stmt = $this->db->prepare($sqlQuery);
		
    }

    public function queryWithPagination($sqlQuery,$start,$limit){
        $sqlQuery = $sqlQuery. " LIMIT :start, :limit";
        $this->stmt = $this->db->prepare($sqlQuery);

        $this->bind(':start', $start, PDO::PARAM_INT);
        $this->bind(':limit', $limit, PDO::PARAM_INT);

    }

    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute($array=array()){
        if( $this->debugIsEnabled){
            print_r($this->stmt);
            //$this->debugIsEnabled = false;
        }
        try{
            if(count($array) > 0){
                return $this->stmt->execute($array);
            }
            else{
                return $this->stmt->execute();
            }
        }
        catch(PDOException $e){
            $this->errors[] = $e->getMessage();
        }
        
    }

    public function getRows(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRowBoth(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_BOTH);
    }
     public function getNumRow(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_NUM);
    }
    public function getRowsObj(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getField(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * [pagination vb. işlemler için. limitli sorgularda, limitsiz toplam row countu döndürür. ]
     * [query de SQL_CALC_FOUND_ROWS göndermek gereklidir.]
     * [örnek query: SQL_CALC_FOUND_ROWS * FROM tabloadi ]
     * @return [assoc array] [result rows]
     */
    public function getRowsWithFoundRows(){
        $this->execute();
        $rows = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->query("SELECT FOUND_ROWS() as totalrows");
        $counter = $this->getRows();
        $this->totalrows = $counter[0]['totalrows'];
        return $rows;

    }
    public function foundRows(){
        return $this->totalrows;
    }

    public function getRowsObject(){
        $this->execute();
        return $this->stmt->fetchObject();
    }

    public function getSingleRow(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->db->lastInsertId();
    }

    public function beginTransaction(){
        return $this->db->beginTransaction();
    }

    public function endTransaction(){
        return $this->db->commit();
    }

    public function cancelTransaction(){
        return $this->db->rollBack();
    }

    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

    public function fetchColumn(){
        return $this->stmt->fetchColumn();
    }

    public static  function SQL_INJECTION($str)
	{
		$str = str_replace('SELECT', '', $str);
		$str = str_replace('select', '', $str);
		$str = str_replace('LIMIT', '', $str);
		$str = str_replace('limit', '', $str);
		$str = str_replace('DELETE', '', $str);
		$str = str_replace('delete', '', $str);
		$str = str_replace('from', '', $str);
		$str = str_replace('FROM', '', $str);
		$str = str_replace(' UPDATE ', '', $str);
		$str = str_replace(' update', '', $str);
		return ($str);
	}
	public static function XSS_CLEAN($str)
	{
		if(is_array($str))  
		{  
			foreach($str as $row)  
			{  
				$return[] = strip_tags($row);   
			}  
		   return $return;  
		}
		else
		{
			return strip_tags($str);
		}
	}
	public static function HTML_CLEAN($str)
	{
		if(is_array($str))
		{
			foreach($str as $row)
			{
				$return[] = htmlentities($str);
			}
		}
		else
		{
			return htmlentities($str);
		}
	}
	public static function SPACE_CLEAN($str)
	{
		if(is_array($str))
		{
			foreach($str as $row)
			{
				$return[] = trim($str);
			}
		}
		else
		{
			return trim($str);
		}
	}
	public static function CLEAN_DATA($str)
	{
		return DB::SPACE_CLEAN(DB::SQL_INJECTION((DB::XSS_CLEAN($str))));
	}
	public static function updateQuery($tableName,  $values = array(), $where = array()) {
		/*
		*USAGE UPDATE FUNCTİON

		    $valueArr = [ column => "value",  ];
		    $whereArr = [ column => "value",  ];
		    $result = basicUpdateQuery("bulk_operations",$valueArr, $whereArr);
		*/
		try {        
		    global $database;

		    //set value
		    foreach ($values as $field => $v)
		        $ins[] = $field. '= :' . $field;
		    $ins = implode(',', $ins);

		    //where value
		    foreach ($where as $fieldw => $vw)
		        $inswhere[] = $fieldw. '= :' . $fieldw;
		    $inswhere = implode(' && ', $inswhere);


		    $sql = "UPDATE  $tableName SET $ins WHERE $inswhere";   
		    $rows = $database->db->prepare($sql);
		    foreach ($values as $f => $v){
		        $rows->bindValue(':' . $f, $v);
		    }
		    foreach ($where as $k => $l){
		        $rows->bindValue(':' . $k, $l);
		    }
		    $result = $rows->execute();

		    return $result;
		} catch (\Throwable $th) {
		    print_r($th->errorInfo[2]);
		    exit;

		}
	}
	public static function insertQuery($table, $array)
	{
		global $database;
		
		$columns = implode(", ", array_keys($array));
		$values  = array_values($array);
		$valCount = count($values);
		$str = '?';
		$str .= str_repeat(", ?", $valCount-1);

		$sql = "INSERT INTO ".$table."(".$columns.") VALUES (".$str.")";
		$results = $database->db->prepare($sql); 

		try { 
			
			if(!$results->execute($values)){
                return ($results->errorInfo());

            }
            else{
                return $database->db->lastInsertId($table);
            }


		} catch(PDOException $e) { 

			return "Error : " . $e->getMessage() . "</br>"; 
			exit;
		} 
	}
	function __destruct()
	{
        // print "bağlantı kapatıldı.";
		$this->db = null;
	} 

}

$database = new DB();
$database->connect(DB_HOST,DB_NAME,DB_USER,DB_PASS);


?>