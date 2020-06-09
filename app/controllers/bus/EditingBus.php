<?php


class EditingBus  implements BusState{

  private $ServiceCheckList;

  private static $editingbus = NULL;
  private static $BusMEModel;
  private static $BusMSModel;

  private function __construct(){
      EditingBus::$BusMEModel = ModelCommon::loading_model('BusME');;
      EditingBus::$BusMSModel = ModelCommon::loading_model('BusMS');
  }

  public static function getInstance(){
    if(!isset(EditingBus::$editingbus)){
      EditingBus::$editingbus = new EditingBus();
    }
    return EditingBus::$editingbus;
  }

  public function stateChange($bus){
    $bus->setState('1'); 
  }

  public function fitAction($params){
    //edit the bus data field -> goto BusModel.
    $bus=EditingBus::$BusMSModel->findByBusNumber($params['BusNumber']);
    $bus->editEntry($params);
    EditingBus::$BusMEModel->NewDistanceTravelledRow($params['BusNumber'],$params['Mileage']);
    // at the end
    $bus->setState(LockedBus::getInstance());  // turn into locked state.
  }

  public function updateDistance($BusNumber,$Distance){

    #check if post or get from nipun
    #update awasthawedi check karanne nane bus eka distance panalada kiyala
    #check if post doesnt work and have to do this like RegisterNewUser

      $bus= EditingBus::$BusMEModel->findByBusNumber($BusNumber);
      //dnd($bus);
      $bus->BusId = EditingBus::$BusMEModel->findIDbyBusNumber($BusNumber);
      if($bus){
          #add the implementation of the checking for service
          $this->populatechecklist($bus->BusId);
          $bus->DistanceIncrement($this->ServiceCheckList,$Distance);
          $bus->save();

      }
    }

    public function updateDetails($data){
        EditingBus::$BusMSModel->edit($data['BusNumber'],$data);
    }

    public function checkId($id){
        //@devin
        EditingBus::$BusMEModel->isBusNumberValid(   $id);
    }



    //}
    public function show($id){
        return ObjecttoArray(EditingBus::$BusMSModel->findByBusNumber($id));
    }

    public function fillAction($params)
    {
        // TODO: Implement fillAction() method.
    }


  public function check($distance,$bus){
    //check for availible all services - @devin , @avishka
    // return arr[]
    foreach($this->ServiceCheckList as $key => $value){
      #please check what to do when $value is null(dont need to check the service for this bus
      #and new service addition)
      if(!($key=='TotalDistanceTravelled') && isset($value)){
        $UpdatedDistance = $bus->{$key} + $distance;
        $bus->{$key} = $UpdatedDistance;
        if($UpdatedDistance >= $value){
          #add service
        }
      }
    }
  }

  private function populatechecklist($id){
    $this->ServiceCheckList= EditingBus::$BusMEModel->populatechecklist($id);
  }

  public function addService($data = []){
    //here create a new service.
    //***** by SYSTEM or FORMAN
    // but forman send empty request @uda , @devin

    // update db @avishka.


  }



}
