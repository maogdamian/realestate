<?php
define('WP_USE_THEMES', false);
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

header('Content-disposition: attachment; filename=backup_'.date("Y_m_d_H_i_s").'.txt');
header('Content-type: application/txt');
echo serialize( get_option( THEME_SLUG . '_options' ) );