<?php

  class View{
    protected $_head,$_body,$_foot, $_siteTitle, $_outputBuffer, $_layout = DEFAULT_LAYOUT;

    public function __construct(){

    }

    public function render($viewName){
      $viewAry = explode('/', $viewName);
      $viewString = implode(DS, $viewAry);

      if(file_exists(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php')){
          if($viewString == 'home\index'){

              include(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php');
          }
          else{
              include(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php');
              include(ROOT.DS.'app'.DS.'views'.DS.'layouts'.DS.$this->_layout.'.php');
          }

      }else{
        die('This view\"'.$viewName.'\" does not exists.');
      }
    }

    public function content($type){
      if($type == 'head'){
          return $this->_head;
      }elseif($type == 'body'){
        return $this->_body;
      }elseif($type == 'foot'){
          return $this->_foot;
      }
      return false;
    }

    public function start($type){
      $this->_outputBuffer = $type;
      ob_start();
    }

    public function end(){
      if($this->_outputBuffer == 'head'){
        $this->_head = ob_get_clean();
      }elseif ($this->_outputBuffer == 'body') {
        $this->_body = ob_get_clean();
      }elseif($this->_outputBuffer == 'foot'){
        $this->_foot = ob_get_clean();
      }else{
        die('You must run the start method.');
      }

    }

    public function siteTitle(){
      if($this->_siteTitle == '') return SITE_TITLE;
      return $this->_siteTitle;
    }

    public function setSiteTitle($title){
      $this->_siteTitle = $title;
    }

    public function setLayout($path){
      $this->_layout = $path;
    }

  }
