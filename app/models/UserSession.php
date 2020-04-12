<?php

class UserSession extends Model{

  public function __construct(){
    $table = 'user_session';
    parent::__construct($table);
  }
}
