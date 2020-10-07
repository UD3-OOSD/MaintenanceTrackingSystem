
<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8">
<?php $this->end() ?>

<?php $this->start('body') ?>

<div class="minicontainer">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2> add <b> Service </b></h2></div>
    </div>
    <form class="form-horizontal hr" method="post" action="addService">
        <div class="dg-danger"><?= $this->displayErrors ?></div>
        <div class="form-group">
            <label class="control-label col-sm-4">Bus number : </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="BusNumber" name='BusNumber' placeholder="Ex:- WP NA-XXXX" value="<?=$this->post['BusNumber']?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Service type</label>
            <div class="col-sm-3">
                <select id="list" name="ServiceType" class="form-control" autofocus="<? $this->post['serviceType']?>" >
                    <option value="<?=$this->post['ServiceType']?>" selected hidden><p><?=$this->post['ServiceType']?></p></option>
                    <option value="Tire">Tire</option>
                    <option value="Oil">Oil</option>
                    <option value="Engine">Engine</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Servicemen :</label>
            <div class="col-sm-4">
                <input type="text" id="servicemen" name='Labourers' class="form-control" value="<?=$this->post['Labourers']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Date : </label>
            <div class="col-sm-4">
                <input type="date" id="ServiceInitiatedDate" name="ServiceInitiatedDate" class="form-control" value="<?=$this->post['ServiceInitialDate']?>" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
            <div class="col-sm-offset col-sm-3">
                <a href=""><button type="button" class="btn btn-default">Refresh</button></a>
            </div>
        </div>
    </form>
</div>

<?php $this->end() ?>
<?php $this->start('foot') ?>

<?php $this->end() ?>
