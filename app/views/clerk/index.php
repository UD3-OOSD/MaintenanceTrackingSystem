<?php $this->setSiteTitle('Clerk') ?>

<?php $this->start('head') ?><link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end() ?>

<?php $this->start('body') ?>
    <div class="container">
        <div class="form-head">
            <div class="col-sm-8 head-text"><h2>Your <b> Info </b></h2></div>
        </div>
        <div>
            <div style="padding: 10px 10px 10px 60px;float: left">
                <img class="" src="<?=PROOT?>app/views/images/profile/<?=$this->post['img_path']?>" alt="Avatar" style="border-radius: 50%;block-size: 150px;border: solid 1px black;">
            </div>
            <div style="float: right;padding: 30px 35% 10px 10px;">
                <p>Labour ID : <?=$this->post['id']?></p>
                <p>Name : <?=$this->post['name']?></p>
                <p>Contact number : <?=$this->post['telNo']?></p>
                <p>Address : <?=$this->post['Address']?></p>
            </div>
        </div>
    </div>
<?php $this->end() ?>