<?php
namespace Models{
	final class todos extends \model {
	    public $id;
	    public $owneremail;
	    public $ownerid;
	    public $createddate;
	    public $duedate;
	    public $message;
	    public $isdone;


	    public function __construct()
	    {
	        $this->tableName = 'todos';
	    
	    }

	    public function insert(){
	        $array = get_object_vars($this);
	        $columnString ='';
	        $valueString = '';
	        foreach ($array as $key => $value) {
	            if($key != 'id' && $key != 'tableName'){
	                $columnString = $columnString . $key . ",";
	                $valueString = $valueString . "'" .$value . "',";
	            }
	        }
	        $columnString = rtrim($columnString, ',');
	        $valueString = rtrim($valueString, ',');
	        $sql = "INSERT INTO todos (" . $columnString . ") VALUES (" . $valueString . ")";
	        return $sql;

	    }

	    public function update() {
	        $array = get_object_vars($this);
	        $updateString='';
	        foreach ($array as $key => $value) {
	            if($key != 'id' && $key != 'tableName'){
	                $updateString = $updateString. $key . "= '". $value . "',";
	            }
	        }
	        $updateString = rtrim($updateString, ',');
	        $sql = "UPDATE todos  SET  ".$updateString." WHERE id=". $this->id;
	        return $sql;

	    }

	    public function delete() {
	        $sql = "DELETE FROM todos WHERE id=".$this->id."";
	        $db = dbConn::getConnection();
	        try {
	            $statement = $db->prepare($sql);
	            $status = $statement->execute();
	        } catch (Exception $e) {
	            print $e->getMessage() . "<br/>";
	        }
	    }
	}
}

?>