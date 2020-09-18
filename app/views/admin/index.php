<?php $this->setSiteTitle('Admin.') ?>

<?php $this->start('head') ?>

<?php $this->end() ?>

<?php $this->start('body') ?>
    <h2 class="text-center  red">Index.!</h2>
<div class="container">
    <div class="form-head">
        <div class="col-sm-8"><h2>bus <b> Registration </b></h2></div>
    </div>
    <div class="">
        <img src="<?=$this->post['img_path']?>">
    </div>
    <div>
        <p>Labour ID : <?=$this->post['id']?></p>
        <p>Name : <?=$this->post['name']?></p>
        <p>Contact number : <?=$this->post['telNo']?></p>
        <p>Address : <?=$this->post['Address']?></p>
    </div>
</div>
<?php $this->end() ?>