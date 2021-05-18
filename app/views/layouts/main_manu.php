<?php

  $menu = Router::getMenu('menu_acl');
  #print_r($menu);
  $currentPage = currentPage();
  #dnd($currentPage);
 ?>

<nav class="navbar navbar-default nav-1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="pr-name">
      <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#main_manu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="" ><?=MENU_BRAND?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="main_manu">
      <ul class="nav navbar-nav ">
        <?php foreach($menu as $key => $val):
          $active = '';?>
          <?php if(is_array($val)): ?>
            <li class="dropdown name-tab">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$key?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php foreach($val as $k => $v):
                  $active = ($v == $currentPage)? 'active':''; ?>
                  <?php if($k == 'separator'): ?>
                    <li role="separator" class="divider"></li>
                  <?php else: ?>
                    <li class="name-tab"><a class="<?=$active?>" href="<?=$v?>"><?=$k?></a></li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            </li>
            <li class="vert-sep"></li>
          <?php else:
            $active = ($val == $currentPage)? 'active':''; ?>
            <li class="name-tab">
                <?php if($key == "Google"): ?>
                    <a class="<?=$active?>" href="<?=$val?>" target="_blank"><?=$key?></a>
                <?php else: ?>
                    <a class="<?=$active?>" href="<?=$val?>"><?=$key?></a>
                <?php endif; ?>
            </li>
            <li class="vert-sep"></li>
          <?php endif; ?>
        <?php endforeach; ?>


      </ul>
      <ul class="nav navbar-nav navbar-right user-bolck">
        <?php if(currentUser()): ?>
          <li class="vert-sep"></li>
            <li class="name-tab"><a href="#"><?=currentUser()->username?></a></li>
          <li><div style="padding: 5px"><img src="<?=PROOT?>app/views/images/profile/<?=currentUser()->img_path?>" alt="Avatar" style="border-radius: 50%;block-size: 40px;border: solid 2px #e0e0e0;"></div></li>
        <?php endif; ?>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
