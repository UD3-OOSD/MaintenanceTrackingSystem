<?php $this->setSiteTitle('admin') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/table-option_1.css" media="screen" title="no title" charset="utf-8" >
<script src="<?=PROOT?>js/table.js"></script>

<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
  <div class="row register">
    <div class="col-sm-6 reg">
      <h1 class="center">edit a bus entry</h1>
      <form class="form-horizontal hr" action="admin/editBus" method="post">
        <div class="dg-danger"><?= $this->displayarr1?></div>
        <div class="form-group">
          <label for="" class="control-label col-sm-4">enter the bus number</label>
          <div class="col-sm-8">
            <input type="text" name="bus_num" value="" placeholder="WX-0000">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-2">
            <button type="submit" name="edit">Edit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row register">
    <div class="col-sm-6 reg">
      <h1 class="center">edit a labour entry</h1>
      <form class="form-horizontal hr" action="admin/editLabour" method="post">
        <div class="dg-danger"><?= $this->displayarr2?></div>
        <div class="form-group">
          <label for="" class="control-label col-sm-4">enter the labour NIC</label>
          <div class="col-sm-8">
            <input type="text" name="lab_id" value="" placeholder="000000000V">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-2">
            <button type="submit" name="edit">Edit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
    /////////////////////////////////
    <div class="table-wrapper">
        <script>fetData = <?=$this->busData?></script>
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Bus <b>Details</b></h2></div>
                <div class="col-sm-4">
                    <div class="search-box">
                        <i class="material-icons">&#xE8B6;</i>
                        <label>
                            <input type="text" id="search_input" class="form-control" placeholder="Search&hellip;">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <table id="selectedColumn" class="table table-striped table-hover table-bordered table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th >Name<i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
                <th>Address</th>
                <th>City <i class="fa fa-sort th-sm" onclick="sortColumn()"></i></th>
                <th>Pin Code</th>
                <th>Country <i class="fa fa-sort th-sm"></i></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="tableData"></tbody>
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
