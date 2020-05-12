<?php
#the bus model
class BusME extends Model{
 private $table;

  public function __construct($bus=''){
    $table='busmileage';
    $this->table = $table;
    parent::__construct($table);
    if ($bus != '') {
      if (is_int($bus)) {
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusId = ?', 'bind'=>[$bus]]);
      }else{
        $b = $this->_db->findFirst('busmileage', ['conditions'=>'BusNumber = ?', 'bind'=>[$bus]]);
      }
      if ($b) {
        foreach ($b as $key => $value) {
          $this->$key = $value;
        }
      }
    }
  }

  public function findByBusNumber($BusNumber){
    return $this->findFirst(['conditions'=>'BusNumber = ?', 'bind'=>[$BusNumber]]);
  }

  public function populatechecklist($id){
    $tables=['bustable','buscategory'];
    $keys = ['BusCategory','BusType'];
    $params = ['BusId','*'];
    $id = ['BusId' => $id];
    $result=$this->LeftJoinSpecific($tables,$keys,$params,$id);
    unset($result['BusId']);
    unset($result['BusType']);
    return($result);
  }

  public function NewDistanceTravelledRow($BusNumber,$Distance){
    $columns = ModelCommon::getColumnNames($this->table);
    $params=['BusNumber'=>$BusNumber];
    #echo(implode('    |||',$columns));
    #dnd('..............................');
    foreach($columns as $key){
      if($key!='BusNumber'){
        $params[$key] = $Distance;
      }
    }
    #echo(implode('    |||',$params));
    #dnd('..............................');
    $this->insert($params);
  }
}
