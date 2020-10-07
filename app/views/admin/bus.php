<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<script type="text/javascript" src="<?=PROOT?>js/tools.js"></script>

<?php $this->end(); ?>
<?php $this->start('body') ?>
<?php //require_once(ROOT.DS.'app'.DS.'views'.DS.'layouts'.DS.'details_sheet.php'); ?>

<div class="container">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2>Edit <b> Bus </b></h2></div>
    </div>
    <form class="form-horizontal hr" method="post" action="saveBus">
      <div class="dg-danger"><?= $this->displayErrors ?></div>
        <div class="form-group">
            <label class="control-label col-sm-4">Registration No.</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="BusNumber" onclick="warn('BusNumber')" name='BusNumber' placeholder="Ex:- WP NA-XXXX" value="<?=$this->post['BusNumber']?>" locked>
                <div id="BusNumber-warn"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Date of Registration</label>
            <div class="col-sm-4">
                <input type="date" id="RegistrationDate" onclick="warn('RegistrationDate')" name='RegistrationDate' class="form-control" value="<?=$this->post['RegistrationDate']?>" locked>
                <div id="RegistrationDate-warn"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Chassis Number</label>
            <div class="col-sm-4">
                <input type="text" id="EngineNumber" name='EngineNumber' class="form-control" value="<?=$this->post['EngineNumber']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Manufactured Year</label>
            <div class="col-sm-4">
                <input type="number" id="ManufacturedYear" onclick="warn('ManufacturedYear')" name='ManufacturedYear' class="form-control" value="<?=$this->post['ManufacturedYear']?>" locked>
                <div id="ManufacturedYear-warn"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Model</label>
            <div class="col-sm-4">
                <select clid="list" name='BusCategory' id="BusCategory" onclick="warn('BusCategory')" class="form-control" value="<?=$this->post['BusCategory']?>" locked>
                    <option value="<?=$this->post['BusCategory']?>" selected hidden><p><?=$this->post['BusCategory']?></p></option>
                    <option value="Demo">Demo</option>
                    <option value="Honda">Honda</option>
                    <option value="Layland">Leyland</option>
                </select>
                <div id="BusCategory-warn"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Colour</label>
            <div class="col-sm-4">
                <input type="text" id="Colour" name='Colour' class="form-control" value="<?=$this->post['Colour']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Current Mileage (km)</label>
            <div class="col-sm-4">
                <input type="number" id="Mileage" name='Mileage' class="form-control"  value="<?=$this->post['Mileage']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">No of seats</label>
            <div class="col-sm-4">
                <input type="number"  id="NumberOfSeats" name='NumberOfSeats' class="form-control" value="<?=$this->post['NumberOfSeats']?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <div class="checkbox">
                    <label><input type="checkbox" name="remember" required>I accept that this registration form is completed only by myself.</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                <button type="submit" class="btn btn-default" name="save" value="save">SAVE</button>
            </div>
            <div class="col-sm-offset col-sm-3">
                <button type="submit" class="btn btn-default" name="delete" value="delete">DELETE</button></a>
            </div>
        </div>
    </form>
</div>
<?php $this->end(); ?>
