<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="png" href="<?=PROOT?>app/views/images/badge.png">

    <title><?=$this->siteTitle(); ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=PROOT?>css/bootstrap.min.css" media="screen" title="no title" charset="utf-8" >
    <link rel="stylesheet" href="<?=PROOT?>css/custom.css" media="screen" title="no title" charset="utf-8" >
    <script src="<?=PROOT?>js/jquery-2.2.4.min.js"></script>
    <script src="<?=PROOT?>js/bootstrap.min.js"></script>

    <?=$this->content('head'); ?>

  </head>
  <body>
    <?php include 'main_manu.php' ?>
    <div class="container-fluid" style="min-height:calc(100% - 125px);">
      <?=$this->content('body'); ?>
    </div>

  </body>
  <body>
  <div class="container-fluid" style="min-height:calc(100% - 125px);">
      <?=$this->content('foot'); ?>
      <h6 class="watermark">designed by UD3</h6>
  </div>
  </body>
</html>
