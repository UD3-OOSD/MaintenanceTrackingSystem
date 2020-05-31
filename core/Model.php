<?php

class Model{
  protected $_db, $_table, $_modelName, $_softDelete =true , $_columnNames = [];
  public $id;

  public function __construct($table){
    $this->_db = DB::getMultitance("admin");
    $this->_table = $table;
    $this->_setTableColumns();
    $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ',$this->_table)));
  }

  protected function _setTableColumns(){
    $columns = $this->get_columns();
    foreach($columns as $column) {
      $columnName = $column->Field;
      $this->_columnNames[] = $columnName;
      $this->{$columnName} = null;
    }
  }

  public function get_columns(){
      #dnd($this->_db);
    return $this->_db->get_columns($this->_table);
  }

  public function find($params = []){
    $results = [];
    $resultsQuery = $this->_db->find($this->_table, $params);
    foreach ($resultsQuery as $result) {
      $obj = new $this->_modelName($this->_table);
      $obj->populateObjectData($result);
      $results[] = $obj;
    }
    return $results;
  }
  public function LeftJoinSpecific($tables,$keys,$params='*',$id=[]){
    $rows = $this->LeftJoin($tables,$keys,$params);
    $ObjectArray = [];
    foreach($rows as $row){
      #echo($row['UserId']);
      if(!($id==[])){
        foreach($id as $key_id => $value_id){
          $key_id = "{$key_id}";
          #echo($key_id);
          #echo($value_id);
          #echo($row[$key_id]);
          #echo($row['UserId']);
          if($row[$key_id]==$value_id){
            return($row);
          }
        }
      }
      return($rows);
    }
    return false;
  }

  public function LeftJoin($tables,$keys,$params='*'){
    $this->_db->LeftJoin($tables,$keys,$params);
    $rows=$this->_db->results();
    return($rows);
    #gives me a 2D array for now can make object but cant use populateObject since cant make object of
    #this model
  }

  public function findFirst($params = []){
    $resultsQuery = $this->_db->findFirst($this->_table, $params);
    $results = new $this->_modelName($this->_table);
    if($resultsQuery){
      $results->populateObjectData($resultsQuery);
    }
    return $results;
  }

  public function findById($id){
    return $this->findFirst(['conditions'=>"id = ?", 'bind' => [$id]]);
  }

  public function save($idtype){
    $fields = [];
    foreach ($this->_columnNames as $column) {
      #echo $this->$column;
      $fields[$column] = $this->$column;
    }
    // determine whether to update or INSERT
    if(property_exists($this, $idtype) && $this->{$idtype} != ''){
      return $this->update($this->{$idtype}, $fields);
    }else{
      #print_r($fields);
      return $this->insert($fields);
    }
  }

  public function insert($fields){
    if(empty($fields))  return false;
    #echo "insert";
    return $this->_db->insert($this->_table, $fields);
  }

  public function update($id, $fields){
    if(empty($fields) || $id = '') return false;
    return $this->_db->update($this->_table, $fields);
  }

  public function delete($id){
    if($id == '' && $this->id = '') return false;
    $id = ($id == '' ) ? $this->id : $id;
    if($this->_softDelete){
      $this->UpdateRow($id, ['deleted' => 1]);
    }
    return $this->_db->deleteRow($this->_table, $id);
  }

  public function query($sql, $bind){
    return $this->_db->query($sql, $bind);
  }

  public function data(){
    $data = new stdClass();
    foreach ($this->_columnNames as $column) {
      $data->column = $this->column;
    }
    return $data;
  }

  public function assign($params){
    if(!empty($params)){
      foreach ($params as $key => $value) {
        #echo $key." ".$value;
        if(in_array($key, $this->_columnNames)){
          $this->$key = sanitize($value);
        }
      }
      return true;
    }
    return false;
  }

  public function isValidKey($params = []){
      $result = $this->find($params);
      if (isset($result)){
          return(true);
      }
      return (false);
  }

  public function addColumn($column_name,$data_type){
    return $this->_db->addColumn($this->_table,$column_name,$data_type);
  }

    public function UpdateRow($unique,$params){
        return $this->_db->UpdateRow($this->_table,$unique,$params);
    }

  protected function populateObjectData($result){
    foreach ($result as $key => $val) {
      $this->$key = $val;
    }
  }

}
