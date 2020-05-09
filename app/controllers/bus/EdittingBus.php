<?php

require_once(ROOT.DS.'app/controllers/bus/BusState.php');


class EdittingBus extends Controller implements BusState{

  private $ServiceCheckList;

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
    if(isset($_POST['Distance']) && isset($_POST['BusNumber'])){
      $validation->check($_POST,[
          'BusNumber' => [
            'display' => 'Vehicle Number',
            'require' => true,
            'unique' => 'bustable',
            'min' => 8  #check
        ],
        'Distance' =>[
          'display' => 'Distance',
          'require' => true,
          'is_numeric' => true
        ]
      ]);

      if($validation->passed()){
        $bus= $this->BusMModel->findByBusNumber($_POST['BusNumber']);
        if($bus){
          $updatedDistanceTravelled = $_POST['Distance'] + $bus->DistanceTravelled;
          $fields = ['DistanceTravelled'=>$updatedDistanceTravelled];
          $bus->update($bus->id,$fields);
            #add the implementation of the checking for service

          $this->populatechecklist($bus->id);
          $this->check();
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
    foreach($this->ServiceCheckList as $key => $value){

    }
  }

  private function populatechecklist($id){
    $this->ServiceCheckList= $this->BusMModel->populatechecklist($id);

  }

  public function addService($data = []){
    //here create a new service.
    //***** by SYSTEM or FORMAN
    // but forman send empty request @uda , @devin

    // update db @avishka.
  }



}
