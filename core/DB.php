<?php

  class DB{
    private static $_instance = null;
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

    public static function getInstance(){
      if(!isset(self::$_instance)){
        self::$_instance = new DB();
      }
      return self::$_instance;
    }

    public function query($sql,$params=[]){
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
      if($this->query($sql, $bind)){
          if(!count($this->_result)) return false;
          return true;
      }
      return false;
    }


    public function find($table, $params = []){
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
      #echo($paramstring);
      #echo '<br>';
      if(isset($tables) && isset($keys) && isset($params) && (count($tables)==2) && (count($keys)==2)){
        $sql =  "SELECT {$paramstring}  FROM {$tables[0]} LEFT JOIN {$tables[1]} ON {$tables[0]}.{$keys[0]} = {$tables[1]}.{$keys[1]}";
        #echo($sql);
        #echo('<br>');
        $prepared=$this->_pdo->prepare($sql);
        $prepared->execute();
        $this->_result=$prepared->fetchALL(PDO::FETCH_ASSOC);
        return true;
      }
      return false;
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
      #echo($paramstring);
      #echo '<br>';
      if(isset($tables) && isset($keys) && isset($params) && (count($tables)==2) && (count($keys)==2)){
        $sql =  "SELECT {$paramstring}  FROM {$tables[0]} Right JOIN {$tables[1]} ON {$tables[0]}.{$keys[0]} = {$tables[1]}.{$keys[1]}";
        echo($sql);
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

    public function results(){
      return $this->_result;
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
  }
