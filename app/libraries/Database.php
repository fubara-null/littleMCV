<?php

/**
* 
*/
class Database{
	private $host   = DB_HOST;
	private $dbUser = DB_USER;
	private $dbPass = DB_PASS;
	private $dbName = DB_NAME;


   private $dbh;
   private $error;
   private $stmt;

   //setting the database
   public function __construct(){
      $dsn = 'mysql:host=' . $this->host . '; dbName=' . $this->dbName; 
      $options = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

      ];

      //Instatiating the PDO...
         try{
      $this->dbh = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
 
   }catch(PDOException $e){
   	$this->error = $e->getmessage();
   	echo $this->error;
   } 

   }

 //Query method for Database
   public function query($sql){
   	$this->stmt = $this->dbh->prepare($sql);
   }

   //binding value
   public function bind($param, $value, $type = null){
   	if(is_null($type)){
   		switch(true) {
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
   				break;
   		}
   	}

   	$this->stmt->bindValue($param, $value, $type);

   }

   // Executing the prepared statement
   public function Execute(){
   	 return $this->stmt->execute();
   }

   //Fetching data 
   public function resultSet(){
   	 $this->Execute();
   	 return $this->stmt->fetchALL(PDO::FETCH_OBJ);
   }

   public function single(){
   	 $this->Execute();
   	 return $this->stmt->fetch(PDO::FETCH_OBJ);
   }

   //Row count
   public function rowCount(){
   	// $this->execute();
   	return $this->stmt->rowCount();

   }

}

?>