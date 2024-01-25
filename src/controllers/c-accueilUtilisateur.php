<?php

require_once('src/model/global.php');

function accueilUtilisateur() {

    $menu['page'] = "accueilUtilisateur";
    require ('view/inc/inc.head.php');
    require ('view/inc/inc.header.php');
    require ('view/v-accueilUtilisateur.php');
    require ('view/inc/inc.footer.php');
}