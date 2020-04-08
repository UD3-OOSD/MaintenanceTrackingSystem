<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $this->siteTitle(); ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=PROOT?>CSS/bootstrap.min.css" media="screen" title="no title" charset="utf-8" >
    <link rel="stylesheet" href="<?=PROOT?>CSS/custom.css" media="screen" title="no title" charset="utf-8" >
    <script src="<?=PROOT?>js/jquery-3.4.1.min.js"></script>
    <script src="<?=PROOT?>js/bootstrap.min.js"></script>

    <?= $this->content('head'); ?>

  </head>
  <body>
    <?= $this->content('body'); ?>

  </body>
</html>
