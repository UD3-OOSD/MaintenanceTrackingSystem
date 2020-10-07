<?php

  class DB{

    private static $users = [];
    private static $locked = [];
    private static $restricted_users = ['Admin','Forman','Mechanic','Clerk','Other'];

    private $_pdo, $_query ,$_error = false, $_result, $_count = 0, $_lastInsertID = null;

    private function __construct(){

      try {
        #echo "1";
        $this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        #$this->_pdo = new PDO("mysql:host=127.0.0.1;dbname=oosd_pr_1",'root','');
      } catch (PDOException $e) {
        die($e->getMessage());
      }

    }

    public static function getMultitance($key='system'){
        #dnd($key);
        #dnd(in_array($key,DB::$restricted_users));
      if(!in_array($key,DB::$restricted_users)){
        if($key == 'mechanic'){
          if(!in_array('mechanic',DB::$users)){
            DB::$users['mechanic'] = new DB();
          }
          return DB::$users['mechanic'];
        }elseif ($key == 'system'){
            if(!in_array('system',DB::$users)){
                DB::$users['system'] = new DB();
            }
            return DB::$users['system'];
        }
        else{return null;}
      }else{
        if(!in_array($key,DB::$locked)){
          if(!in_array($key,DB::$users)){
              //dnd(DB::$users);
              DB::$locked[$key] = new DB();
              return DB::$locked[$key];
          }else{
              return DB::$users[$key];
          }

        }else{
          return null;
        }  
      }
    }

    public static function reset_lock($key){
      if(isset($locked[$key])){
        $users[$key] = $locked[$key];
        unset($locked[$key]);  ///can be error.
      }
    }


    public function query($sql,$params=[]){
      $this->_error = false;
      #print_r($params);
      #echo $sql.'<\br>';
      #echo($sql);
      #echo('<br>');
      #echo(implode('    |||',$params));
      #echo('<br>');
      if ($this->_query = $this->_pdo->prepare($sql)) {
        #dnd($params);
        $x =  1;
        #print_r($params);
        #echo('<br>');
        if (is_array($params) && count($params)) {
          foreach ($params as $param) {
            $this->_query->bindValue($x, $param);
            $x++;
          }
        }


        #dnd('..............................');
          #print_r($this->_query);
            #echo('<br>');
        if ($this->_query->execute()) {
          $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
          $this->_count = $this->_query->rowCount();
          $this->_lastInsertID = $this->_pdo->lastInsertId();
        }else{
          $this->_error = true;
        }
      }
      return $this;
    }

    protected function _read($table, $params = []){
      $conditionString = '';
      $bind = [];
      $order = '';
      $limit = '';

      //conditions
       // echo($params['conditions'].$table);
        #print_r($params);
      if (isset($params['conditions'])) {
        if (is_array($params['conditions'])) {
          foreach ($params['conditions'] as $condition) {
            $conditionString .= ' '.$condition.' AND';
          }

          $conditionString = trim($conditionString);
          $conditionString = rtrim($conditionString,' AND');

        }else {
            $conditionString = $params['conditions'];
        }


        if($conditionString != ''){
          $conditionString = ' Where '.$conditionString;
        }

      }
      #echo($conditionString);
      //echo($conditionString);
      //bind
      if(array_key_exists('bind', $params)){
        $bind = $params['bind'];
      }
      //order
      if(array_key_exists('order', $params)){
        $roder = 'ORDER BY'.$params['order'];
      }

      //limit
      if(array_key_exists('limit', $params)){
        $limit = ' LIMIT '.$params['limit'];
      }
      #echo($conditionString);
        #print_r($conditionString);
        #echo('<br>');
      #print_r($order);
        #echo('<br>');
        #print_r($limit);
        #echo('<br>');

      $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
      #echo('<br>');
      #echo($sql);
      #echo('<br>');
      #echo($sql);
        //print_r($bind);
      if($this->query($sql, $bind)){
          if(!count($this->_result)) return false;
          return true;
      }
      return false;
    }




    public function find($table, $params = []){
        #dnd($params);
      if($this->_read($table, $params)){
        return $this->results();
      }
      return false;
    }


    public function findFirst($table, $params=[]){
      if($this->_read($table, $params)){
        return $this->first();
      }
      return false;
    }



    public function getColumnNames($table){
      $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'{$table}'";
      #echo($sql);
      #echo('<br>');
      if (isset($table)) {
        $this->runSQL($sql);
        #dnd($fieldString);
        #$this->query($sql);
        return true;
      }
      #dnd($valueString);
      return false;
    }


    public function LeftJoin($tables,$keys,$params){
      $paramstring='';
      $values=[];

      if($params!='*'){
        foreach($params as $param){
          $paramstring .= $param.', ';
        }
        $paramstring = substr($paramstring,0,strlen($paramstring)-2);
      }
      else{
          $paramstring=$params;
      }
      //dnd($paramstring);
      #echo '<br>';
      if(isset($tables) && isset($keys) && isset($params) && (count($tables)==2) && (count($keys)==2)){
        $sql =  "SELECT {$paramstring}  FROM {$tables[0]} LEFT JOIN {$tables[1]} ON {$tables[0]}.{$keys[0]} = {$tables[1]}.{$keys[1]}";
        //dnd($sql);
        #echo('<br>');
        $this->runSQL($sql);
        return true;
      }
      return false;
    }

    public function runSQL($sql){
        $prepared = $this->_pdo->prepare($sql);
        if ($prepared->execute()) {
            $this->_result = $prepared->fetchALL(PDO::FETCH_ASSOC);
            return true;
        }
        return  false;
    }

    public function RightJoin($tables,$keys,$params){
      $paramstring='';
      $values=[];

      if($params!='*'){
        foreach($params as $param){
          $paramstring .= $param.', ';
        }
        $paramstring = substr($paramstring,0,strlen($paramstring)-2);
      }
      //dnd($paramstring);
      #echo '<br>';
      if(isset($tables) && isset($keys) && isset($params) && (count($tables)==2) && (count($keys)==2)){
        $sql =  "SELECT {$paramstring}  FROM {$tables[0]} Right JOIN {$tables[1]} ON {$tables[0]}.{$keys[0]} = {$tables[1]}.{$keys[1]}";
        #echo($sql);
        #echo('<br>');
        $prepared=$this->_pdo->prepare($sql);
        $prepared->execute();
        $this->_result=$prepared->fetchALL(PDO::FETCH_ASSOC);
        return true;
      }
      return false;
    }


    public function insert($table, $fields = []){
      $fieldString = '';
      $valueString = '';
      $values = [];

      foreach ($fields as $field => $value) {
        $fieldString .= '`'.$field.'`,';
        $valueString .= '?,';
        $values[] = $value;
      }
      $fieldString = rtrim($fieldString, ',');
      $valueString = rtrim($valueString, ',');
      $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";
      if (!$this->query($sql, $values)->error()) {
        #dnd($fieldString);
        return true;
      }
      #dnd($valueString);
      return false;
    }

    public function update($table, $id, $fields = []){
      $fieldString = '';
      $values = [];
      foreach ($fields as $field => $value) {
        $fieldString .= ' '.$field.' = ?,';
        $values[] = $value;
      }
      $fieldString = trim($fieldString);
      $fieldString = rtrim($fieldString, ',');
      $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
      //dnd( $sql);
      if (!$this->query($sql, $values)->error()) {
        return true;
      }
      return false;
      #$sql = "UPDATE contact SET f-name = 'Antonie' WHERE id = 3";
    }

    #not done nipun please check


    public function delete($table, $id){
      $sql = "DELETE FROM {$table} WHERE id = {$id}";
      if(!$this->query($sql)->error()){
        return true;
      }
      return false;
    }

      public function deleteRow($table, $unique){
          foreach ($unique as $key => $val) {
              $sql = "DELETE FROM {$table} WHERE {$key} = {$val}";
              #echo($sql);
              #echo('<br>');
              if (!$this->query($sql)->error()) {
                  return true;
              }
          }
          return false;

      }

    public function results(){
      return $this->_result;
    }

    public function clear_results(){
        return $this->_result = null;
    }

    public function first(){
      return (!empty($this->_result))? $this->_result[0] : [];
    }

    public function count(){
      return $this->_count;
    }

    public function lastID(){
      return $this->_lastInsertID;
    }

    public function get_columns($tables){
      return $this->query("SHOW COLUMNS FROM {$tables}")->results();
    }

    public function error(){
      return $this->_error;
    }


    public function addColumn($table,$column_name,$data_type,$default) {
        #echo($table);
        #echo('<br>');
        #echo($data_type);
        #echo('<br>');
        #echo($column_name);
        #echo('<br>');
        #echo($default);
        #echo('<br>');
        if (!is_null($data_type)&& !is_null($column_name) && !is_null($table)){
            if($default == null){
                $sql ="ALTER TABLE {$table} ADD {$column_name} {$data_type} NULL";
            }else{
                $sql = "ALTER TABLE {$table} ADD {$column_name} {$data_type} NOT NULL DEFAULT {$default}";
            }
            #dnd($sql);
            if($this->query($sql)){
                return(true);
            }

        }
        #dnd('lol');
        return (false);
    }


    public function UpdateRow($table,$unique,$params){
        $fieldString = '';
        $values = [];
        foreach ($params as $field => $value) {
            $fieldString .= ' '.$field.' = ?,';
            $values[] = $value;
        }
        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString, ',');
        foreach ($unique as $key => $val){
            $val="'{$val}'";
            $sql = "UPDATE {$table} SET {$fieldString} WHERE {$key} = {$val}";
            #echo($sql);
            #echo('<br>');
            if (!$this->query($sql, $values)->error()) {
                return true;
            }
        }
        return false;
    }

    public function numOfRows($table){
        if(isset($table)){
            $sql = "SELECT COUNT(*) FROM {$table}";
            if ($this->runSQL($sql)) {
                return $this->results();
            }
        }
        return false;
    }





    #return array functions
    public function queryArray($sql,$params=[]){
      $this->_error = false;
      if ($this->_query = $this->_pdo->prepare($sql)) {
        $x =  1;
        if (count($params)) {
          foreach ($params as $param) {
            $this->_query->bindValue($x, $param);
            $x++;
          }
        }

        if ($this->_query->execute()) {
          $this->_result = $this->_query->fetchAll(PDO::FETCH_ASSOC);
          $this->_count = $this->_query->rowCount();
          $this->_lastInsertID = $this->_pdo->lastInsertId();
        }else{
          $this->_error = true;
        }
      }
      return $this;
    }

    protected function _readArray($table, $params = []){
      $conditionString = '';
      $bind = [];
      $order = '';
      $limit = '';

      //conditions
      if (isset($params['conditions'])) {
        if (is_array($params['conditions'])) {
          foreach ($params['conditions'] as $condition) {
            $condition .= ' '.$condition.' AND';
          }
          $conditionString = trim($conditionString);
          $conditionString = rtrim($conditionString,' AND');
        }else{
          $conditionString = $params['conditions'];

        if($conditionString != ''){
          $conditionString = ' Where '.$conditionString;
        }
      }
    }
      //bind
      if(array_key_exists('bind', $params)){
        $bind = $params['bind'];
      }
      //order
      if(array_key_exists('order', $params)){
        $roder = 'ORDER BY'.$params['order'];
      }

      //limit
      if(array_key_exists('limit', $params)){
        $limit = ' LIMIT '.$params['limit'];
      }
      $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
      if($this->queryArray($sql, $bind)){
          if(!count($this->_result)) return false;
          return true;
      }
      return false;
    }

    public function findArray($table, $params = []){
      if($this->_readArray($table, $params)){
        return $this->results();
      }
      return false;
    }

    public function findFirstArray($table, $params=[]){
      if($this->_readArray($table, $params)){
        return $this->firstArray();
      }
      return false;
    }

    public function selectAll($table,$column,$key){
        //dnd('enters');// ($table!='') && ($column!='') && ($key!='')
        if(isset($table) && isset($column) && isset($key)){
            //dnd('passed');
            $sql="SELECT * FROM {$table} WHERE {$column} = ? ";
            $bind=[$key];
            //dnd($sql);
            if($this->query($sql,$bind)){
                return(true);
            }
        }
        return(false);
    }

      public function selectAllArray($table,$column,$key){
          #echo($key);
          #echo($column);
          #echo($table);
          #dnd(($table!='') && ($column!=''));
          if( ($table!='') && ($column!='')){
              $key="'".$key."'";
              $sql="SELECT * FROM {$table} WHERE {$column} = {$key}";
              //dnd($sql);
              if($this->runSQL($sql)){
                  return(true);
              }
          }
          return(false);
      }

  }
