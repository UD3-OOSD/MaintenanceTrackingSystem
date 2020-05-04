<?php

class EdittingBus extends Controller implements BusState{

  public function stateChange($bus){
    $bus->setState(new LockedBus());
  }

  public function fitAction($bus,$attr){
    //edit the bus data field -> goto BusModel.

    // at the end
    $bus->setState(new LockedBus());  // turn into locked state.
  }

  public function updateDistance(){
    #check if post or get from nipun
    #update awasthawedi check karanne nane bus eka distance panalada kiyala
    #check if post doesnt work and have to do this like RegisterNewUser
    $validation = new Validate();
    if(isset($_POST['distance']) && isset($_POST['vehical_num'])){
      $validation->check($_POST,[
        'vehical_num' => [
          'display' => 'Vehical Number',
          'require' => true
        ],
        'distance' =>[
          'display' => 'Distance',
          'require' => true,
          'is_numeric' => true
        ]
      ]);

      if($validation->passed()){
        $bus= $this->BMModel->findByVehicleNum($_POST['vehical_num']);
        if($bus){
          $updated = $_POST['distance'] + $bus->travelled;
          $fields = ['travelled'=>$updated];
          $bus->update($bus->id,$fields);
        }
      }
    }



    //update attribute and deal with db @avishka.

    //check for service.@avishka

    //$arr = $this->check($dis);

    //if(!empty($arr)){
    // $this->addService($data);
    //}
  }

  public function check($data){
    //check for availible all services - @devin , @avishka
    // return arr[]
  }

  public function addService($data = []){
    //here create a new service.
    //***** by SYSTEM or FORMAN
    // but forman send empty request @uda , @devin

    // update db @avishka.
  }



}
