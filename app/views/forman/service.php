
<?php $this->start('head') ?>
    <link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8">
    <script type="text/javascript" src="<?=PROOT?>js/tools.js"></script>
<?php $this->end() ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2> Edit <b> Service </b></h2></div>
    </div>
    <form class="form-horizontal hr" method="post" action="saveService">
        <div class="dg-danger"><?= $this->displayErrors ?></div>
        <div class="form-group">
            <label class="control-label col-sm-4">Serice ID :</label>
            <div class="col-sm-4">
                <input type="text" id="ServiceId" name="ServiceId" onclick="warn('ServiceId')" class="form-control" value="<?=$this->post['ServiceId']?>" locked>
            </div>
            <div id="ServiceId-warn"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Bus number : </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="BusNumber" onclick="warn('BusNumber')" name='BusNumber' placeholder="Ex:- WP NA-XXXX" value="<?=$this->post['BusNumber']?>" locked>
            </div>
            <div id="BusNumber-warn"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Service type :</label>
            <div class="col-sm-4">
                <select clid="list" name="serviceType" id="serviceType" onclick="warn('serviceType')" class="form-control" autofocus="<?=$this->post['ServiceType']?>" locked>
                    <option value="<?=$this->post['ServiceType']?>" selected disabled hidden><p><?=$this->post['ServiceType']?></p></option>
                    <option value="Tire">Tire</option>
                    <option value="Oil">Oil</option>
                    <option value="Engine">Engine</option>
                </select>
            </div>
            <div id="serviceType-warn"></div>
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
                <input type="date" id="servicedate" name='ServiceInitialDate' class="form-control" value="<?=$this->post['ServiceDate']?>" >
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


<?php $this->end() ?>