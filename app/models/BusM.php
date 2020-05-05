<?php
#the bus model
class BusM extends Model{



  public function __construct($bus=''){
    $table='bustable';
    parent::__construct($table);
    if ($bus != '') {
      if (is_int($bus)) {
        $u = $this->_db->findFirst('users', ['conditions'=>'id = ?', 'bind'=>[$user]]);
      }else{
        $u = $this->_db->findFirst('users', ['conditions'=>'vehicle_num = ?', 'bind'=>[$user]]);
      }
      if ($u) {
        foreach ($u as $key => $value) {
          $this->$key = $value;
        }
      }
    }
  }

  public function findByVehicleNum($VehicalNum){
    return $this->findFirst(['conditions'=>'vehicle_num = ?', 'bind'=>[$VehicleNum]]);
  }

  public function registerNewBus($params){
    $this->assign($params);
    $this->deleted = 0;
    $this->save();
  }






}
