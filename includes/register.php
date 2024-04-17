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


	if(isset($_POST['idAdmin'])){
		$idAdmin = $_POST['idAdmin'];
	}else{
		$result = 2;
		$_SESSION['error'] = "El idAdmin no puede estar vacío";
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


	$user_id = username_exists( $email );
	if ( !$user_id and email_exists($email) == false ) {

		$data_user=array(
			'user_login' => $email,
			'user_email' => $email,
			'user_pass' => $pass,
			'first_name' => $nombre

			);
		$user_id = wp_insert_user( $data_user );
		

		//Creamos la relacion con el administrador
	    $sql = 'INSERT INTO wp_members_group (idUsu, idAdmin, activo)
	    VALUES ( '.$user_id.', '.$idAdmin.', 0)';
	    $conn->query($sql);	


	    //Introducimos valores extra de los participantes
	    $sql = 'INSERT INTO wp_members_details (idUsu, cp, telefono, fechaRegistro)
	    VALUES ( '.$user_id.', '.$cp.', '.$tFijo.', "'.$date.'")';
	    $conn->query($sql);	

	    $_SESSION['error'] = "Miembro de grupo registrado correctamente.";

	} else {
		$_SESSION['error'] = "El email usado ya existe";
		$result=2;
	}


    header("Location:" . URL_RESULT.  "?result=". $result);
	exit();
?>