<?php
namespace  Itrax;
class dbWrapper
{
    public $conn;
    public $sql;
    public $query;

    function __construct($server,$username,$password,$database,$port=3306){
        $this->conn=mysqli_connect($server,$username,$password,$database,$port);
    }
    function select($table,$colums){
        $this->sql="select $colums from `$table`";
       return $this;
    }
    function where($colums,$compire,$value) {
        $this->sql.=" Where `$colums` $compire '$value' ";
        return $this;
        
    }
    function andWhere($colums,$compire,$value) {
        $this->sql.=" AND `$colums` $compire '$value' ";
        return $this;
        
    }
    function orWhere($colums,$compire,$value) {
        $this->sql.=" OR `$colums` $compire '$value' ";
        return $this;
        
    }
    function getAll(){
        $this->query();
        while($row=mysqli_fetch_assoc($this->query) ){
            $data[]=$row;
        }
        return $data;
    }

    function getRow(){
        $this->query();
        $row=mysqli_fetch_assoc($this->query) ;
    
        return $row;
    }
    function insert($table,$data)
    {
        $this->sql="INSERT into `$table` SET ";  
        $this->prepareData($data);
        // echo $this->sql;die();
        return $this;   
    }
    function exec()
    {
        $this->query();
        if(mysqli_affected_rows($this->conn)>0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    function delete($table){
        $this->sql="DELETE from `$table`";
       return $this;
    }
    function updata($table,$data)
    {
        $this->sql="update `$table` SET ";
        $this->prepareData($data);
       
        return $this;   

    }
    function prepareData($data)
    {
        foreach($data as $key=>$row){
            $value= (gettype($row)=='string')?"'$row'":$row ;
            $this->sql.=" `$key` = ".$value.",";
        }
        $this->sql=rtrim($this->sql,",");
    }
    function query(){

        $this->query=mysqli_query($this->conn,$this->sql);
    }
    public function __destruct(){
        mysqli_close($this->conn);
    }

}
?>