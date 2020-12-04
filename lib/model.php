<?php

  class model
  {
    
    public $table; //table should be access
    private $conn;  //object of connection to database
    private $result; //result of all functions


    // condtructor always connected to database
    public function __construct()
    {
    	$this->conn = Database::config();
    }
   


    /**
     * function to set table of access
     *
     * @param table : name of table
    */

  	public function set($table)
  	{
  		$this->table=$table;
  	}

    /**
     * to specific records get from database
     *
     * @param record: name of record specific from database
     * @param value: the value from user to define 
     */

  	public function where($value,$spec="*")
    {
	      	$query = "SELECT {$spec} FROM {$this->table} WHERE {$value}";
	      	$stmt = $this->conn->prepare($query);
	      	$stmt->execute(); 
          $stmt->setFetchMode(\PDO::FETCH_OBJ);
          $this->result = $stmt->fetchAll();
          return $this->result;
          
    }


   
    // to get values of extract multi records from database 
    public function get($spec="*")
    {
      
        $query = "SELECT {$spec} FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); 
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $this->result = $stmt->fetchAll();     
        return $this->result;  
    }


    // to get values of one record from database 
    public function first()
    {
      
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(); 
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $this->result = $stmt->fetch();
        return $this->result;
    }

    // to get values of one record from database by id number
    public function find($id,$spec="*")
    {
      $query = "SELECT {$spec} FROM {$this->table} WHERE id=:id";
      $stmt = $this->conn->prepare($query);
      $stmt->execute(['id' => $id]); 
      $stmt->setFetchMode(\PDO::FETCH_OBJ);
      $result = $stmt->fetchObject();
      return $result;
    }

    

    /**
     * to create new record in table
     *
     * @param records = ['name of record' => 'value of record']: names and values records of table to create new one
     */
    public function create($records = [])
    {

      if(array_keys($records) !== range(0, count($records) - 1)) 
      {
        $arr_keys = implode(',' , array_keys($records));

        $arr_keys_val = "";
        for($i = 0 ; $i < count(array_keys($records)) ; $i++)
        {
          $arr_keys_val .= ":".array_keys($records)[$i];

          if ($i != count(array_keys($records))-1) 
          {
            $arr_keys_val .=",";
          }
        }

        $binds = explode(',', $arr_keys_val);

        $query = "INSERT INTO {$this->table} ({$arr_keys}) VALUES ({$arr_keys_val})";

        $add_record = $this->conn->prepare($query);
        
        for ($i=0; $i < count(array_values($records)); $i++) 
        { 
          $add_record->bindParam($binds[$i] , array_values($records)[$i]);
        }
        
        $add_record->execute();
        return true;

      
      }else
      {
        return false;
      }
           
    }
    

    /**
     * to update record with number of id
     *
     * @param id : number of id record which we need update it
     * @param records = ['name of record' => 'value of record']: names and values records of table to update record
     */
    public function update($id , $records=[])
    {
       

       if(array_keys($records) !== range(0, count($records) - 1)) 
       {
        $query = "UPDATE {$this->table} SET ";
        
        for ($i=0; $i < count(array_keys($records)); $i++) 
        { 
          if (array_values($records)[$i] != null) 
          {
            $query .= array_keys($records)[$i]." = '".array_values($records)[$i]."' ";
          }

          if ($i < (count(array_keys($records))-1)) 
          {
               
               $query .= ' , ';
          }
        }
        

        $query .= "WHERE id = :id";

        if(count(array_keys($records)) == 1 && array_values($records)[0] == null)
        {
          return false;
        }

        $update_record = $this->conn->prepare($query);

        $update_record->execute(['id' => $id]);
        return true;
       }else
       {
        return false;
       }

    }



    /**
     * to delete record from table
     *
     * @param id : number of id record which we need delete it
     */

    public function destroy($id)
    {
       $check = $this->find($id);
       if(!$check)
       {
        return false;
       }

       if(filter_var($id, FILTER_VALIDATE_INT) == false)
       {
        return false;
       }

       $query = "DELETE FROM {$this->table} WHERE id = {$id}";
      
       if ($this->conn->exec($query)) 
       {
         return true;        
       }
       return false;    
    }
}

     
