<?php
require_once('src/model/global.php');
function historique()
{
    $menu['page'] = "historique";
    require('view/inc/inc.head.php');
    require('view/inc/inc.header.php');
    require('view/v-historique.php');
    require('view/inc/inc.footer.php');
}