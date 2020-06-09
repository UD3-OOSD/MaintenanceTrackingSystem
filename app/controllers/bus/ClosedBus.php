<?php



class ClosedBus  implements BusState{

  private static $closedbus = NULL;
  private static $BusMSModel;

  private function __construct(){
      ClosedBus::$BusMSModel = ModelCommon::loading_model('BusMS');
  }

  public static function getInstance(){
    if(!isset(ClosedBus::$closedbus)){
      ClosedBus::$closedbus = new ClosedBus();
    }
    return ClosedBus::$closedbus;
  }

  public function stateChange($bus){
    //no idea about state change @devin
    //$this->delete();  // like
  }

  public function delete($id){ // or can call directly to Model @avishka.
    //delete from $bussess with related services but not all. @avishka
    // add soft delete function to here. @devin
    ClosedBus::$BusMSModel->delete($id,'BusNumber');
  }

    public function updateDistance($BusNumber,$Distance)
    {
        // TODO: Implement updateDistance() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function fillAction($params)
    {
        // TODO: Implement fillAction() method.
    }
}
