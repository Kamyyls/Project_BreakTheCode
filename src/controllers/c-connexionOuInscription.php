<?php

require_once('src/model/global.php');
require_once ('src/model/user.php');
function connexionOuInscription(){
     $menu['page'] = "connexionOuInscription";
     require ('view/inc/inc.head.php');
     require ('view/inc/inc.header.php');
     require ('view/v-connexionOuInscription.php');
     require ('view/inc/inc.footer.php');
}