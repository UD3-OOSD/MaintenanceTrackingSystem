<?php

class ModelCommon{

  public static function  find($table,$params = []){
    $db= DB::getMultitance();
    $results = [];
    $resultsQuery = $db->findArray($table, $params);
    /*
    foreach ($resultsQuery as $result) {


      foreach($result as $key=>$value){
        echo($value);
        echo('<br>');
      }



    }
    */
    return $resultsQuery;
  }

  public static function getColumnNames($table){
    $db= DB::getMultitance();
    $db->getColumnNames($table);
    $rows = $db->results();
    $values=[];
    foreach($rows as $row){
      array_push($values,$row['COLUMN_NAME']);
    }
    return($values);
  }

  public static function addColumn($table,$column_name,$data_type){
      $db = DB::getMultitance();
      $db->addColumn($table,$column_name,$data_type);
  }

  public static function UpdateRow($table, $id, $fields){
      $db = DB::getMultitance();
      $db->updateRow($table, $id, $fields);

  }

  public static function validationID($table , $column ,$value){
      $db = DB::getMultitance();
      $params=['conditions'=> "{$column} = ?",'bind'=>[$value]];
      #print_r($params);
      #echo('<br>');
      #echo("{$column} = ?");
      #print_r($db->find($table,$params));
      if ($db->find($table,$params)){
          return(true);
      }
      return (false);
  }

  public static function loading_model( $model){
      if (class_exists($model)) {
          return (new $model());
      }
  }

  public static function nextID($table){
      $db= DB::getMultitance();
      $value = $db->numOfRows($table);
      $count = $value[0]["COUNT(*)"];
      $count++;
      return "{$count}";
  }



  public static function ObjectTOArray($obj){
    if (is_object($obj)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $obj = get_object_vars($obj);
        #echo(implode('    |||',$obj));
    }

    if (is_array($obj)) {
        /*S
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        #echo(implode('    |||',$obj));
        return array_map(__FUNCTION__, $obj);
    } else {
        // Return array
        return $obj;
    }
  }
}
