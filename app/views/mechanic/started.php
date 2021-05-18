<?php $this->setSiteTitle('Started_Maintanance.') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/table-option_1.css" media="screen" title="no title" charset="utf-8" >
<script src="<?=PROOT?>js/table_sbh.js"></script>
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8 head-text"><h2>Started <b>Maintenance</b></h2></div>
            <div class="table-filter">
                <div class="search_box">
                    <label>Search:</label>
                    <input type="text" id="search_input" class="search-box"  placeholder=" Id..">
                </div>
            </div>
        </div>
    </div>
    <div class="area">
    <table id="selectedColumn" class="table table-body table-striped table-bordered table-sm">
        <thead>
        <tr class="table_header">
            <th class="index">#</th>
            <th>ServiceId<i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
            <th>ServiceType</th>
            <th>BusNumber <i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
            <th>ServiceStartDate <i class="fa fa-sort th-sm"></i></th>
        </tr>
        </thead>
        <tbody class="table_body" id="tableData"></tbody>
    </table>
    </div>
</div>
<?php $this->end() ?>
<?php $this->start('foot') ?>
<script src="<?=PROOT?>js/table_f.js">
</script>
<?php $this->end() ?>
