<?php

class Model{
  protected $_db, $_table, $_modelName, $_softDelete =true , $_columnNames = [];
  public $id;
    protected $idtype;

    public function __construct($table,$name = '',$acl='Other'){
    $this->_db = DB::getMultitance($acl);
    $this->_table = $table;
    $this->acl = $acl;
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
    #dnd($params);
    #dnd($params);
    $resultsQuery = $this->_db->find($this->_table, $params);
    #dnd($this->_db->results());
    if(!empty($resultsQuery)){
        foreach ($resultsQuery as $result) {
            //dnd($this->_modelName);
            $obj = new $this->_modelName($this->_table);
            $obj->populateObjectData($result);
            $results[] = $obj;
        }
    }
    return $results;
  }



  public function setTableState($state){
      #dnd(isset($this->{$this->idtype}));
      if (isset($this->{$this->idtype})){
          return $this->setTableStateID($this->{$this->idtype},$state);
      }
      return false;
  }

  public function LeftJoinSpecific($tables,$keys,$params='*',$id=[]){
    $rows = $this->LeftJoin($tables,$keys,$params);
    #dnd($rows);
    $result = [];
    if(!($id==[])){
        foreach($rows as $row){
      #print_r($id);
            foreach($id as $key_id => $value_id){
                if($row[$key_id]==$value_id){
                 $result[] = $row;
                 }
             }
        }
        return $result;
    }
    return $rows;
  }

  public function LeftJoin($tables,$keys,$params='*'){
    $this->_db->LeftJoin($tables,$keys,$params);
    $rows=$this->_db->results();
    return($rows);
    #gives me a 2D array for now can make object but cant use populateObject since cant make object of
    #this model
  }

  public function findFirst($params = []){
    #$params = $this->_softDeleteParams($params);
    $resultsQuery = $this->_db->findFirst($this->_table, $params);
    //dnd($params);
    $results = new $this->_modelName($this->_table);
    if($resultsQuery){
      $results->populateObjectData($resultsQuery);
    }
    //($results);
    return $results;
  }

  public function findById($id){
    return $this->findFirst(['conditions'=>"id = ?", 'bind' => [$id]]);
  }

  public function save(){
    $idtype=$this->idtype;
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

  public function delete($id='',$idname=''){
        //dnd('ojhaeuhbfyr3w');
    if($id == '' && $idname = '') return false;

    $id = ($id == '' ) ? $this->{$idname} : $id;

    if($this->_softDelete){
      return $this->UpdateRow([$idname=> $id], ['deleted' => 1]);
    }
    else {
        return $this->_db->deleteRow($this->_table, $id);
    }
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

  public function isDeleted($unique){
        foreach ($unique as $key=>$value){
            $sql =  "SELECT deleted  FROM {$this->_table} WHERE {$key} = {$value}";
            $this->query($sql);
            
        }
  }

  public function isValidKey($params = []){
      if($params != []){
          foreach ($params as $key => $value){
              $result = $this->selectAllArray($key,$value);
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

  public function addColumn($column_name,$data_type,$default = null){
    return $this->_db->addColumn($this->_table,$column_name,$data_type,$default);
  }

    public function UpdateRow($unique,$data){
      //dnd($data);
      $params=[];
        foreach ($data as $key=> $value){
           if(in_array($key,$this->_columnNames)){
               $params[$key] = $value;
           }
        }
        return $this->_db->UpdateRow($this->_table,$unique,$params);
    }

  protected function populateObjectData($result){
    foreach ($result as $key => $val) {
      $this->$key = $val;
    }
  }

  public function selectAll($column,$key, $filter=true,  $single_lock = true){
        //dnd('selectall');
        $results = $this->selectAllWithDelete($column,$key);
        if($filter){
            $results = filter($results);
        }
      if($single_lock){
          if (count($results)==1){
              return($results[0]);
          }
      }
        return ($results);

   }

    public function selectAllWithDelete($column,$key){
        $results=[];
        if($this->_db->selectAll($this->_table,$column,$key)){
            //echo('hgbvuvdvu');
            //dnd($this->_db->results()>0);
            if($this->_db->results()>0){
                foreach ($this->_db->results() as $item){
                    $results[]=$item;
                }
                return $results;
            }
        }
        return false;
    }

    public function selectAllArray($column,$key, $filter=true ,$single_lock = true){
        $results = $this->selectAllArrayWithDelete($column,$key);
        if($filter){
            $results = filter($results);
        }
        if($single_lock){
            if (count($results)==1){
                return($results[0]);
            }
        }
        return ($results);
    }

    public function selectAllArrayWithDelete($column,$key){
        $results=[];
        if($this->_db->selectAllArray($this->_table,$column,$key)){
            if($this->_db->results()>0){
                foreach ($this->_db->results() as $item){
                    $results[]=$item;
                }
                return $results;
            }
        }
        return false;
    }

}
