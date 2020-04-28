<?php

  define('DEBUG', true);

  define('DB_NAME', 'oosd_pr_1');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_HOST', '127.0.0.1');

  define('DEFAULT_CONTROLLER', 'Home'); //default controller
  // if url is not defined.
  define('DEFAULT_LAYOUT', 'default'); // this outputs if we doesnt init layout.

  define('PROOT', '/framework_1/'); //set to the root of thr live server.


  define('SITE_TITLE', 'OOSD'); // this is the site title
  define('MENU_BRAND', 'OOSD'); // This is the brand text in the main menu

  define('CURRENT_USER_SESSION_NAME', 'awdAwdadwWDADawadADWAWdADDwadDD'); // session for login user
  define('REMEMBER_ME_COOKIE_NAME', 'AdAdAWDdNVJDiDJkDnJDvBjjDjk'); // cookie name for logged in user remember me
  define('REMEMBER_ME_COOKIE_EXPIRY', 604800); // expiry time is 30 dates.

  define('ACCESS_RESTRICTED', 'Restricted'); //controller name is Restricted redirect
