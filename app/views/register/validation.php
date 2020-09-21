<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="minicontainer">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2> Key <b> Validation </b></h2></div>
    </div>
    <div class="bg-danger"><?= $this->displayErrors ?></div>
    <form class="form-horizontal hr" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-4">Enter validation key : </label>
            <div class="col-sm-4">
                <input type="text" name="val_key" class="form-control" value="" id="val_key">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-2">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>

</div>
<?php $this->end(); ?>

