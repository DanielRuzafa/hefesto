<?php 
global $current_user; get_currentuserinfo(); 
if ($current_user->ID > 0) { 
	$nameRole = $current_user->roles[0];
}else{
	$nameRole = "";
}

if ($current_user->ID > 0) { 
	if ($nameRole=="administrator"){ 
		require_once("menu-admin.php");
	}else{ 
		require_once("menu-user.php");
	}

} 
?>