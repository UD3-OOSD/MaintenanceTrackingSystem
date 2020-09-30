<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<script type="text/javascript" src="<?=PROOT?>js/tools.js"></script>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="minicontainer">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2> User <b> Register </b></h2></div>
    </div>
    <div class="bg-danger"><?= $this->displayErrors ?></div>
  <form class="form-horizontal hr" action="" method="post">
      <div class="form-group">
          <label class="control-label col-sm-4">Labour id</label>
          <div class="col-sm-4">
              <input type="text" name="lab_id" onclick="warn('lab_id')" class="form-control" value="<?=$this->post['lab_id']?>" id="lab_id">
          </div>
          <div id="lab_id-warn"></div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-4" for="rank">Rank</label>
          <div class="col-sm-4">
              <select clid="list" id="acl" onclick="warn('acl')" name="acl" class="form-control">
                  <option value="<?=$this->post['acl']?>" selected hidden><p><?=$this->post['acl']?></p></option>
                  <option value="Admin">Admin</option>
                  <option value="Forman">Forman</option>
                  <option value="Mechanics">Mechanics</option>
                  <option value="Clerk">Clerk</option>
                  <option value="Other">Other</option>
              </select>
          </div>
          <div id="acl-warn"></div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-4">Email</label>
          <div class="col-sm-4">
              <input type="email" name="email" class="form-control" value="<?=$this->post['email']?>" id="email">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-4">Username</label>
          <div class="col-sm-4">
              <input type="text" name="username" class="form-control" value="<?=$this->post['username']?>" id="username">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-4">Password</label>
          <div class="col-sm-4">
              <input type="password" name="password" class="form-control" value="<?=$this->post['password']?>" id="password">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-sm-4">Confirm password</label>
          <div class="col-sm-4">
              <input type="password" name="confirm" class="form-control" value="<?=$this->post['confirm']?>" id="confirm">
          </div>
      </div>
      <div class="form-group">
          <div class="col-sm-offset-4 col-sm-3">
              <button type="submit" class="btn btn-default">Register</button>
          </div>
      </div>
  </form>

</div>
<?php $this->end(); ?>
