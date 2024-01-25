<?php

require_once('src/model/global.php');
function regles(){
    $menu['page'] = "regles";
    require ('view/inc/inc.head.php');
    require ('view/inc/inc.header.php');
    require('view/v-regles.php');
    require('view/inc/inc.footer.php');
}