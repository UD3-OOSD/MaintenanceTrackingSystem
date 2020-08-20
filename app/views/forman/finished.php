<?php $this->setSiteTitle('Finished_Maintanance.') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/table-option_1.css" media="screen" title="no title" charset="utf-8" >
<link rel="stylesheet" href="<?=PROOT?>css/table.css" media="screen" title="no title" charset="utf-8" >
<script src="<?=PROOT?>js/table_h.js"></script>
<?php $this->end() ?>

<div class="table-wrapper">
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8"><h2>Bus <b>Details</b></h2></div>
            <div class="col-sm-4">
                <div class="search_box">
                    <input type="text" id="search_input"  placeholder="Fliter Table Using Names">
                </div>
            </div>
        </div>
    </div>
    <table id="selectedColumn" class="table table-body table-striped table-hover table-bordered table-sm">
        <thead>
        <tr class="table_header">
            <th>#</th>
            <th>ServiceId<i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
            <th>ServiceType</th>
            <th>BusNumber <i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
            <th>ServiceDate <i class="fa fa-sort th-sm"></i></th>
        </tr>
        </thead>
        <tbody class="table_body" id="tableData"></tbody>
    </table>
    <div class="clearfix">
        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
        <ul class="pagination">
            <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
            <li class="page-item"><a href="#" class="page-link">1</a></li>
            <li class="page-item"><a href="#" class="page-link">2</a></li>
            <li class="page-item active"><a href="#" class="page-link">3</a></li>
            <li class="page-item"><a href="#" class="page-link">4</a></li>
            <li class="page-item"><a href="#" class="page-link">5</a></li>
            <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
        </ul>
    </div>

</div>
<?php $this->end() ?>
<?php $this->start('foot') ?>
<h2>designed by WD3</h2>
<script src="<?=PROOT?>js/table_f.js">
</script>
<?php $this->end() ?>

