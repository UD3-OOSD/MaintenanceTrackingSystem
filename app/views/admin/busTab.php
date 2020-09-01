<?php $this->setSiteTitle('admin') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/table-option_1.css" media="screen" title="no title" charset="utf-8" >
<script src="<?=PROOT?>js/table_h.js"></script>

<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8"><h2>Bus <b>Details</b></h2></div>
            <div class="table-filter">
                <div class="search_box">
                    <label>Search:</label>
                    <input type="text" id="search_input" class="search-box"  placeholder=" Id..">
                </div>
            </div>
        </div>
    </div>
    <div class="area">
        <table id="selectedColumn" class="table table-body table-striped table-hover table-bordered table-sm">
            <thead>
            <tr class="table_header">
                <th class="index">#</th>
                <th>BusId<i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
                <th>BusNumber</th>
                <th>BusCategory <i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
                <th>EngineNumber</th>
                <th>RegistrationDate <i class="fa fa-sort th-sm"></i></th>
            </tr>
            </thead>
            <tbody class="table_body" id="tableData"></tbody>
        </table>
    </div>
</div>
<?php $this->end() ?>

<?php $this->start('foot');?>
<script src="<?=PROOT?>js/table_f.js">
</script>
<?php $this->end()?>
