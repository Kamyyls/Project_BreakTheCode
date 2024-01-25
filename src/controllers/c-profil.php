<?php

require_once('src/model/global.php');
function profil(){
    $menu['page'] = "profil";
    require ('view/inc/inc.head.php');
    require ('view/inc/inc.header.php');
    require('view/v-profil.php');
    require('view/inc/inc.footer.php');
}