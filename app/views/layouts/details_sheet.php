
<div class="container-fluid">
  <h1><?=$this->heading?></h1>
  <ul>
    <?php foreach($this->details as $name => $detail):?>
    <li>
      <p><?=$name?>.' :'</p>
      <p><?=$detail?></p>
    </li>
  <?php endforeach; ?>
  </ul>
  <a href="" id="c006">Back</a>
</div>
