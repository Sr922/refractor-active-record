<?php

abstract class model {
    protected $tableName;

    protected function getTableName(){
        $tableName = get_called_class();
        if(get_called_class() == 'accounts')
            $tableName = 'accounts';
        else
            $tableName = 'todos';

        return $tableName;
    }
    public function save()
    {
        if ($this->id == '') {
            $sql = $this->insert();
        } else {
            $sql = $this->update();
        }
        // echo $sql;
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $status = $statement->execute();
        
        if($status == 1&& $this->id == ''){
            $this->id = $db->lastInsertId();
        }
    }

    abstract public function insert();
    abstract public function update();
    abstract public function delete();

    // private function insert() {
    //     $tableName = $this->getTableName();
    //     // $array = get_object_vars($this);
    //     // $columnString ='';
    //     // $valueString = '';
    //     // foreach ($array as $key => $value) {
    //     //     if($key != 'id' && $key != 'tableName'){
    //     //         $columnString = $columnString . $key . ",";
    //     //         $valueString = $valueString . "'" .$value . "',";
    //     //     }
    //     // }
    //     // $columnString = rtrim($columnString, ',');
    //     // $valueString = rtrim($valueString, ',');
    //     // $sql = "INSERT INTO $tableName (" . $columnString . ") VALUES (" . $valueString . ")";
    //     // return $sql;
    // }
    // private function update() {
        // $tableName = $this->getTableName();
        // $array = get_object_vars($this);
        // $updateString='';
        // foreach ($array as $key => $value) {
        //     if($key != 'id' && $key != 'tableName'){
        //         $updateString = $updateString. $key . "= '". $value . "',";
        //     }
        // }
        // $updateString = rtrim($updateString, ',');
        // $sql = "UPDATE $tableName  SET  ".$updateString." WHERE id=". $this->id;
        // return $sql;
        
    // }
    // public function delete() {
        // $tableName = $this->getTableName();
        // $sql = "DELETE FROM ".$tableName." WHERE id=".$this->id."";
        // $db = dbConn::getConnection();
        // try {
        //     $statement = $db->prepare($sql);
        //     $status = $statement->execute();
        // } catch (Exception $e) {
        //     print $e->getMessage() . "<br/>";
        // }
        
    // }
}

// final class todos extends model {
//     public $id;
//     public $owneremail;
//     public $ownerid;
//     public $createddate;
//     public $duedate;
//     public $message;
//     public $isdone;


//     public function __construct()
//     {
//         $this->tableName = 'todos';
    
//     }

//     public function insert(){
//         $array = get_object_vars($this);
//         $columnString ='';
//         $valueString = '';
//         foreach ($array as $key => $value) {
//             if($key != 'id' && $key != 'tableName'){
//                 $columnString = $columnString . $key . ",";
//                 $valueString = $valueString . "'" .$value . "',";
//             }
//         }
//         $columnString = rtrim($columnString, ',');
//         $valueString = rtrim($valueString, ',');
//         $sql = "INSERT INTO todos (" . $columnString . ") VALUES (" . $valueString . ")";
//         return $sql;

//     }

//     public function update() {
//         $array = get_object_vars($this);
//         $updateString='';
//         foreach ($array as $key => $value) {
//             if($key != 'id' && $key != 'tableName'){
//                 $updateString = $updateString. $key . "= '". $value . "',";
//             }
//         }
//         $updateString = rtrim($updateString, ',');
//         $sql = "UPDATE todos  SET  ".$updateString." WHERE id=". $this->id;
//         return $sql;

//     }

//     public function delete() {
//         $sql = "DELETE FROM todos WHERE id=".$this->id."";
//         $db = dbConn::getConnection();
//         try {
//             $statement = $db->prepare($sql);
//             $status = $statement->execute();
//         } catch (Exception $e) {
//             print $e->getMessage() . "<br/>";
//         }
//     }
// }

?>