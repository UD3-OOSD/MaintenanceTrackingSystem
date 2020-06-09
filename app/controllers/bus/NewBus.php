<?php



class NewBus  implements BusState{

  private static $newbus = NULL;
  private static $BusMSModel;
  private static $BusMEModel;

    private function __construct(){
      NewBus::$BusMSModel = ModelCommon::loading_model('BusMS');
      NewBus::$BusMEModel = ModelCommon::loading_model('BusME');
  }

  public static function getInstance(){
    if(!isset(NewBus::$newbus)){
      NewBus::$newbus = new NewBus();
    }
    return NewBus::$newbus;
  }

  public function stateChange($bus){
    $bus->setState('1');
  }

  public function fillAction($params){
    //dnd($params);
    NewBus::$BusMSModel->registerNewBus($params);
    #echo($params['Mileage']);
    #dnd('_____________');
    NewBus::$BusMEModel->NewBusDistanceUpdate($params['BusNumber'],$params['Mileage']);

        #Router::redirect('admin');  #will have to change
  }
    //create a record and fill it.-> goto BusModel.


  public function updateDistance($BusNumber,$Distance){
    echo('Error');
  }

  public function show($id){
      return ObjecttoArray(NewBus::$BusMSModel->findByBusNumber($id));
  }

}
