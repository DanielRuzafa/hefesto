<?php
global $current_user; get_currentuserinfo(); 
global $rolUser;



    if ($current_user->ID != 0) {
        $rolUser = $current_user->roles[0];
    }
    else{
        $rolUser = "";
    }


?>        