<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?=PROOT?>css/home_index.css" media="screen" title="no title" charset="utf-8" >

<?php $this->end(); ?>
<?php $this->start('body') ?>
<?php require_once(ROOT.DS.'app'.DS.'views'.DS.'layouts'.DS.'details_sheet.php'); ?>
<?php $this->end(); ?>
