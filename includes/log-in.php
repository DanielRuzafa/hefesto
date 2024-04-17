<?php 
    if(!session_id()){
        session_start();
    }
	require_once('../../../../wp-blog-header.php');
	require_once('../../../../wp-includes/user.php');

	
	// define variables and set to empty values
	$usu = $pass =  "";

	$result=1;

	$usu = get_user_by( 'email', $_POST["email"] );

	if($usu->roles[0]=="subscriber"){
		//define("URL_RESULT", "http://" . $_SERVER['HTTP_HOST']. "/grupo/");
		define("URL_RESULT", "http://" . $_SERVER['HTTP_HOST']. "/hefesto/grupo/");
	}else{
		//define("URL_RESULT", "http://" . $_SERVER['HTTP_HOST']. "/administrador-grupo/");
		define("URL_RESULT", "http://" . $_SERVER['HTTP_HOST']. "/hefesto/administrador-grupo/");
	}

	//define("URL_RESULT_ERROR", "http://" . $_SERVER['HTTP_HOST']. "/");
	define("URL_RESULT_ERROR", "http://" . $_SERVER['HTTP_HOST']. "/hefesto/");



	if(!$usu){
		$result = 2;
		$_SESSION['error'] = "El usuario no existe. Por favor vuelva a intentarlo.";
	}else{

		$adminAux=false;
		//Comprobamos si esta accediendo un administrador
		if(!isset($usu->caps['administrator'])){
			$adminAux=false;

		}else{
			$adminAux=true;
		}

		if((getActivatedMember($usu->ID))||($adminAux)){
			$pass = $_POST["pass"];
			$creds = array();
			$creds['user_login'] = $usu->user_login;
			$creds['user_password'] = $pass;
			$creds['remember'] = true;
			$user = wp_signon( $creds, false );
			if ( is_wp_error($user) ){
				$result = 2;
				$_SESSION['error'] = "El usuario o la contraseña son incorrectos.";
			}
		}else{
			$result = 2;
			$_SESSION['error'] = "Su usuario no ha sido activado aun.";			
		}


	}

	if($result==2){
	    header("Location:" . URL_RESULT_ERROR.  "?result=". $result);
		exit();
	}else{

	    header("Location:" . URL_RESULT);
		exit();
	}
?>