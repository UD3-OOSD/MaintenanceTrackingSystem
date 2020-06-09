<?php $this->setSiteTitle('Clerk') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/form.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end() ?>

<?php $this->start('body') ?>
    <div class="container">
        <div class="row register" id="y1">
            <div class="col-sm-3"></div>
            <div class="col-sm-5 reg">
                <h1>Mileage Update Form</h1>
                <form class="form-horizontal hr" method="post" action="clerk/update">
                    <div class="dg-danger"><?= $this->displayErrors ?></div>
                    <div class="form-group">
                        <label class="control-label col-sm-5">Registration No.</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="xx" name ='reg_no' placeholder="Ex:- WP NA-XXXX" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5">Bus ID</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="xx" name='bus_id'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5">Previous Mileage (km)</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="xx" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5">Current Mileage (km)</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="xx" name='mileage' required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-2">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                        <div class="col-sm-offset-1 col-sm-2">
                            <button type="button" class="btn btn-default">Refresh</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $this->end() ?>
