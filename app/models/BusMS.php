<?php
#the bus model
class BusM extends Model{



  public function __construct($bus=''){
    $table='bustable';
    parent::__construct($table);
    if ($bus != '') {
      if (is_int($bus)) {
        $b = $this->_db->findFirst('bustable', ['conditions'=>'BusId = ?', 'bind'=>[$bus]]);
      }else{
        $b = $this->_db->findFirst('bustable', ['conditions'=>'BusNumber = ?', 'bind'=>[$bus]]);
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

  public function registerNewBus($params){
    $this->assign($params);
    $this->DistaceTravelled = 0;
    $this->deleted = 0;
    $this->save();
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
}
