<?php

class ModelCommon{
  protected $_db,$_softDelete = false;

  public function __construct(){
    $this->_db = DB::getInstance();
    $this->_setTableColumns();
  }


  public static function getRows($table,$check){

  }

  public function getColumnNames($table){
    $this->_db->getColumnNames($table);
    $rows = $this->_db->results();
    $values=[];
    foreach($rows as $row){
      array_push($values,$row['COLUMN_NAME']);
    }
    return($values);
  }

  
