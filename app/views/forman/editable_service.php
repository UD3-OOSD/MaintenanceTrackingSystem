<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/forman.css" media="screen" title="no title" charset="utf-8" >

<?php $this->end(); ?>
<?php $this->start('body') ?>
<div class="container">
    <div class="row register" id="y2">
        <div class="col-sm-3"></div>
        <div class="col-sm-5 reg">
            <div class="form-head">
                <div class="col-sm-8 head-text"><h2>Service <b> Form </b></h2></div>
            </div>
            <form class="form-horizontal hr" method="post" action=".php">
                <div class="form-group">
                    <label class="control-label col-sm-4">Bus ID</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="xx" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Service Category</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="xx" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Date</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Labour IDs</label>
                    <div class="col-sm-6">
                        <textarea name="" id="yy" cols="18" rows="2"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Service Details</label>
                    <div class="col-sm-6">
                        <textarea name="" cols="32" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                    <div class="col-sm-offset-1 col-sm-3">
                        <a href="ServiceRequestForm.html"><button type="button" class="btn btn-default">Refresh</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->end(); ?>
