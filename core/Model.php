<?php

class Model{
  protected $_db, $_table, $_modelName, $_softDelete =true , $_columnNames = [];
  public $id;

  public function __construct($table,$name = ''){
    $this->_db = DB::getMultitance("admin");
    $this->_table = $table;
    $this->_setTableColumns();
    if($name == ''){
    $this->_modelName = str_replace(' ', '', ucwords(str_replace('_', ' ',$this->_table)));}
    else{    $this->_modelName = $name;}

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
    #$params = $this->_softDeleteParams($params);
      //dnd($this->_db);
    $results = [];
    $resultsQuery = $this->_db->find($this->_table, $params);

    foreach ($resultsQuery as $result) {
        //dnd($this->_modelName);
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
    $params = $this->_softDeleteParams($params);
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
    #echo($idtype);
    foreach ($this->_columnNames as $column) {
      #echo $this->$column;
      $fields[$column] = $this->$column;
    }
    // determine whether to update or INSERT
     #dnd($idtype);
    #dnd(property_exists($this, $idtype));
     #dnd(ModelCommon::validationID($this->_table,$idtype,$this->{$idtype}));
    if(property_exists($this, $idtype) && ModelCommon::validationID($this->_table,$idtype,$this->{$idtype})){
      #dnd('doesnt work');
      return $this->update($idtype ,$this->{$idtype}, $fields);
    }else{
        #dnd('correct');
      #print_r($fields);
      #dnd('.......................................');
      return $this->insert($fields);
    }
  }

  public function insert($fields){
      #dnd($fields);
    if(empty($fields))  return false;
    #echo "insert";
      #print_r($fields);
      #dnd('..........$$$...........................');
    return $this->_db->insert($this->_table, $fields);
  }

  public function update($idtype , $id, $fields){
    if(empty($fields) || $id == '') return false;
    return $this->_db->UpdateRow($this->_table,[$idtype=>$id],$fields);
  }

  public function delete($idtype,$id){
    if($id == '' && $this->{$idtype} = '') return false;
    $id = ($id == '' ) ? $this->id : $id;
    if($this->_softDelete){
      $this->UpdateRow($id, ['deleted' => 1]);
    }
    return $this->_db->deleteRow($this->_table, $id);
  }

    protected function _softDeleteParams($params){
        if($this->_softDelete){
            if(array_key_exists('conditions',$params)){
                if(is_array($params['conditions'])){
                    $params['conditions'][] = "deleted != 1";
                }else{
                    $params['conditions'] .= " AND deleted != 1";
                }
            }else{
                $params['conditions'] = "deleted != 1";
            }
        }
        return $params;
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
      if($params != []){
          foreach ($params as $key => $value){
              $statement=['conditions' => "{$key}",'bind'=>$value];
              #dnd($statement);
              $result = $this->find($statement);
              #dnd($result);
              if ($result){
                  #dnd('trueeee');
                  return(true);
              }
          }
      }
      return (false);
      #dnd($params);
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
