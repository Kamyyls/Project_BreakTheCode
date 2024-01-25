<?php

require_once('src/model/global.php');
function accueil(){
    $menu['page'] = "accueil";
    require ('view/inc/inc.head.php');
    require ('view/inc/inc.header_Connecte.php');
    require('view/v-accueil.php');
    require('view/inc/inc.footer.php');
}