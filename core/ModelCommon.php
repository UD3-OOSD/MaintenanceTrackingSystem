<?php

class ModelCommon{

  public static function  find($table,$params = []){
    $db= DB::getInstance();
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
    $db= DB::getInstance();
    $db->getColumnNames($table);
    $rows = $db->results();
    $values=[];
    foreach($rows as $row){
      array_push($values,$row['COLUMN_NAME']);
    }
    return($values);
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
