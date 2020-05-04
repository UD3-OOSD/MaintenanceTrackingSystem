<?php
#the bus model
class BM extends Model{



  public function __construct($bus=''){
    $table='bus_details';
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

  




}
