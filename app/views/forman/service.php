
<?php $this->start('head') ?>
    <link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8">
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
                <input type="text" id="ServiceId" name='serviceId' class="form-control" value="<?=$this->post['ServiceId']?>" locked="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Bus number : </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="BusNumber" name='BusNumber' placeholder="Ex:- WP NA-XXXX" value="<?=$this->post['BusNumber']?>" locked>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Service type :</label>
            <div class="col-sm-4">
                <select clid="list" name="serviceType" class="form-control" autofocus="<?=$this->post['serviceType']?>" locked>
                    <option value="Engine service">Engine service</option>
                    <option value="axel service">axel service</option>
                    <option value="gear box service">gear box service</option>
                    <option value="break pad & break oil">break pad & break oil</option>
                    <option value="Other">Other</option>
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
                <input type="date" id="servicedate" name='ServiceInitialDate' class="form-control" value="<?=$this->post['ServiceDate']?>" >
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-1">
                <button type="submit" class="btn btn-default" name="save" value="save">SAVE</button>
            </div>
            <div class="col-sm-offset-1 col-sm-1">
                <button type="submit" class="btn btn-default" name="delete" value="delete">DELETE</button></a>
            </div>
        </div>
    </form>
</div>


<?php $this->end() ?>