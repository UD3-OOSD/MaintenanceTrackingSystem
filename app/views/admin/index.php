<?php $this->setSiteTitle('admin') ?>

<?php $this->start('head') ?>

<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
  <div class="row register">
    <div class="col-sm-6 reg">
      <h1 class="center">edit a bus entry</h1>
      <form class="form-horizontal hr" action="" method="post">
        <div class=""><?= $this->displayarr1?></div>
        <div class="form-group">
          <label for="" class="control-label col-sm-4">enter the bus number</label>
          <div class="col-sm-8">
            <input type="text" name="bus_num" value="" placeholder="WX-0000">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-2">
            <button type="submit" name="edit">Edit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row register">
    <div class="col-sm-6 reg">
      <h1 class="center">edit a bus entry</h1>
      <form class="form-horizontal hr" action="" method="post">
        <div class=""><?= $this->displayarr2?></div>
        <div class="form-group">
          <label for="" class="control-label col-sm-4">enter the labour NIC</label>
          <div class="col-sm-8">
            <input type="text" name="lab_id" value="" placeholder="000000000V">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-2">
            <button type="submit" name="edit">Edit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
</div>
<?php $this->end() ?>
