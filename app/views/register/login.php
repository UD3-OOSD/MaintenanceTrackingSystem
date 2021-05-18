<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<div class="minicontainer">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2> Log <b> In</b></h2></div>
    </div>
  <div class="bg-danger"><?=$this->displayErrors ?></div>
  <form class="form-horizontal hr" action="<?=PROOT?>register/login" method="post">
      <div class="form-group">
          <label class="control-label col-sm-4">Username</label>
          <div class="col-sm-4">
              <input type="text" class="form-control" id="BusNumber" name='username' >
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-4">password</label>
          <div class="col-sm-4">
              <input type="password" name='password' class="form-control" ">
              <div id="datewarn"></div>
          </div>
      </div>
    <div class="form-group">
      <label for="remember_me" class="control-label col-sm-8">Remember me<input type="checkbox" id="remember_me" name="remember_me" value="on"></label>
    </div>
      <div class="form-group">
          <div class="col-sm-offset-3 col-sm-3">
              <button type="submit" class="btn btn-default">Log in</button>
          </div>
          <div class="col-sm-offset col-sm-3">
              <a href="<?=PROOT?>register/validate"><button type="button" class="btn btn-default">Register</button></a>
          </div>
      </div>

</div>
<?php $this->end(); ?>
