
<?php $this->setSiteTitle('Home'); ?>

<?php $this->start('head'); ?>
  <link rel="stylesheet" href="<?=PROOT?>css/home_index.css" media="screen" title="no title" charset="utf-8" >
  <meta content="test /">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3">
      <img id="c001" class="mx-auto d-block" width="90" src="app/views/images/Emblem_of_Sri_Lanka.png">
      <!-- Original => width="172" height="245" -->
    </div>
    <div id="c002" class="col-sm-6 col-md-6 col-lg-6">
      <h3 class="mx-auto d-block">Sri Lanka Transport Board - Horana Depot</h3>
      <h3 class="mx-auto d-block">ශ්‍රී ලංකා ගමනාගමන මණ්ඩලය - හොරණ ඩිපෝව</h3>
      <h3 class="mx-auto d-block"> <font size = "5"> இலங்கை போக்குவரத்து சபை - ஹொரானா டிப்போ</h3>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
      <img id="c003" class="mx-auto d-block" width="200" height="120" src="app/views/images/sltb-sri-lanka-transport-board-logo-F90A8F0DBE-seeklogo.png">
      <!-- Original => width="300" height="151" -->
    </div>
  </div>
  <div class="c004">
    <h1>Welcome !</h1>
  </div>
  <div class="c005">
    <a href="<?=PROOT?>register/login" id="c006">Log In</a>
    <a href="https://www.facebook.com/horana.depot" id="c006">Visit us on fb</a>
  </div>
</div>
<?php $this->end(); ?>



<?php

/*
<?php $this->setSiteTitle('Home') ?>

<?php $this->start('head') ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<?php $this->end(); ?>
*/
 ?>
