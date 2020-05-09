<?php $this->setSiteTitle('Bus Registration Form') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
        <div class="row register">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 reg">
                <h1>Bus Registration Form</h1>
                <form class="form-horizontal hr" method="post" action=".php">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Registration No.</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="xx" placeholder="Ex:- WP NA-XXXX">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Date of Registration</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Chassis Number</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="xx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Manufactured Year</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="xx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Model</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="xx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Colour</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="xx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Current Mileage (km)</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="xx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">No of seats</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="xx">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember">I accept that this registration form is completed only by myself.</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-2">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                        <div class="col-sm-offset-1 col-sm-2">
                            <a href="BusReg.html"><button type="button" class="btn btn-default">Refresh</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->end() ?>
