<?php 
    if(!session_id()){
        session_start();
    }
    require_once('../../../../wp-config.php');
	require_once('../../../../wp-blog-header.php');
	require_once('../../../../wp-includes/user.php');


    //define("URL_RESULT", "http://".$_SERVER['HTTP_HOST'] . "/");
    define("URL_RESULT", "http://".$_SERVER['HTTP_HOST'] . "/hefesto/");
    
	$result=1;

	// Create connection
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$conn->set_charset("utf8");


	if(isset($_POST['idUsu'])){
		$idUsu = $_POST['idUsu'];
	}else{
		$result = 2;
		$_SESSION['error'] = "El Id del usuario no puede estar vacío";
	}

	if(isset($_POST['nombre'])){
		$nombre = cleanupentries($_POST['nombre']);
	}else{
		$result = 2;
		$_SESSION['error'] = "El nombre no puede estar vacío";
	}


	if(isset($_POST['cp'])){
		$cp = cleanupentries($_POST['cp']);
	}else{
		$result = 2;
		$_SESSION['error'] = "El CP no puede estar vacío";
	}


	if(isset($_POST['tFijo'])){
		$tFijo = cleanupentries($_POST['tFijo']);
	}else{
		$result = 2;
		$_SESSION['error'] = "El Teléfono no puede estar vacío";
	}
	

	if(isset($_POST['email'])){

		//Comprobamos que es un email lo que se introduce
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$email = $_POST['email'];
		}else{
			$result = 2;
			$_SESSION['error'] = "El email no es valido";
		}
	}else{
		$result = 2;
		$_SESSION['error'] = "El email no puede estar vacío";
	}


	if(isset($_POST['pass'])){
		$pass = $_POST['pass'];
	}else{
		$result = 2;
		$_SESSION['error'] = "La contraseña no puede estar vacía";
	}
	if(isset($_POST['year'])){
		$year = cleanupentries($_POST['year']);
	}else{
		$result = 2;
		$_SESSION['error'] = "El año no puede estar vacío";
	}

	if(isset($_POST['month'])){
		$month = cleanupentries($_POST['month']);
	}else{
		$result = 2;
		$_SESSION['error'] = "El mes no puede estar vacío";
	}

	if(isset($_POST['day'])){
		$day = $_POST['day'];
	}else{
		$result = 2;
		$_SESSION['error'] = "El dia no puede estar vacío";
	}

	$date = $day . "/" . $month . "/". $year;

	//Email con los datos de acceso registro

	/*
	$f_email = "calidad@secitologia.org";
	
	$send_subject = "Registro Control Calidad SEC";
	$headers = "From: " . $f_email . "\r\n" .
	    "Reply-To: " . $f_email . "\r\n" .
	    "X-Mailer: PHP/" . phpversion();

	$result=1;*/

	$existUser = username_exists( $email );

	if (!$existUser) {
		$_SESSION['error'] = "El miembro del grupo tiene que existir.";
		$result=2;

	} else {


		$data_user=array(
			'ID' => $idUsu,
			'user_email' => $email,
			'user_pass' => $pass,
			'first_name' => $nombre

			);

		$userId = wp_update_user( $data_user );

		if(checkMemberDetails($idUsu)){
			
			$sql = 'UPDATE wp_members_details SET cp="'. $cp .'", telefono="'.$tFijo.'" WHERE idUsu=' . $idUsu;
		}else{
	    	$sql = 'INSERT INTO wp_members_details (idUsu, cp, telefono, fechaRegistro)
	    	VALUES ( '.$idUsu.', '.$cp.', '.$tFijo.', "'.$date.'")';

		}

	    if ($conn->query($sql) !== TRUE) {
			$result=2;
			$_SESSION['error'] = "ERROR: Al guardar los datos. Vuelve a intentarlo en unos minutos.";
			

	    }else{
	    	$_SESSION['error'] = "Datos guardados correctamente.";
	    }		
	}



    header("Location:" . URL_RESULT.  "?result=". $result);
	exit();
?>