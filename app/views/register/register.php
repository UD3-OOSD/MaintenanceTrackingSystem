<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">
  <h3 class="text-center ">Register Here!</h3><hr>
  <form class="form" action="" method="post">
    <div class="dg-danger"><?= $this->displayErrors ?></div>
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" value="<?=$this->post['name']?>" id="name">
    </div>
    <div class="form-group">
      <label for="acl">Rank</label>
      <input type="text" name="acl" class="form-control" value="<?=$this->post['acl']?>" id="acl">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" value="<?=$this->post['email']?>" id="email">
    </div>
    <div class="form-group">
      <label for="username">Choose a Username</label>
      <input type="text" name="username" class="form-control" value="<?=$this->post['username']?>" id="username">
    </div>
    <div class="form-group">
      <label for="password">Choose a Password</label>
      <input type="password" name="password" class="form-control" value="<?=$this->post['password']?>" id="password">
    </div>
    <div class="form-group">
      <label for="confirm">Confirm Password</label>
      <input type="password" name="confirm" class="form-control" value="<?=$this->post['confirm']?>" id="confirm">
    </div>
    <div class="pull-right">
      <input type="submit" class="btn btn-primary btn-large" value="Register">
    </div>
  </form>

</div>
<?php $this->end(); ?>
