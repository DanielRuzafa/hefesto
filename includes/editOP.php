<?php
    if(!session_id()){
        session_start();
    }

	require_once('../../../../wp-config.php');
	require_once('../../../../wp-blog-header.php');
	require_once('../../../../wp-includes/user.php');


    //define("URL_RESULT", "http://".$_SERVER['HTTP_HOST'] . "/operaciones/");
    define("URL_RESULT", "http://".$_SERVER['HTTP_HOST'] . "/hefesto/operaciones/");
    
	$result=1;

	// Create connection
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$conn->set_charset("utf8");



	if(isset($_POST['importSubmit'])){



		if(isset($_POST['idOpe'])){
			$idOpe = cleanupentries($_POST['idOpe']);
		}else{
			$result = 2;
			
		}

		if(isset($_POST['name'])){
			$name = cleanupentries(strtoupper($_POST['name']));
		}else{
			$result = 2;
			
		}

		if(isset($_POST['niv'])){
			$niv = cleanupentries($_POST['niv']);
		}else{
			$result = 2;
			
		}

		if(isset($_POST['estado'])){
			$estado = $_POST['estado'];
		}else{
			$result = 2;
			
		}


		if(isset($_POST['date'])){
			$date = formatDate($_POST['date']);
		}else{
			$result = 2;
			
		}


		if(isset($_POST['membersOpe'])){
			$membersOpe = explode("usu", $_POST['membersOpe']);

		}else{
			$result = 2;
			
		}

		if(isset($_POST['description'])){
			$description = cleanupentriesDesc($_POST['description']);
		}else{
			$result = 2;
			
		}


    	//Comprobamos si el valor del nombre no esta vacio
    	if($name!=""){

    		//Comprobamos que el nombre de la operacion no coincide con otro si se modifica
    		if(!checkNameOPEdited($name, $idOpe)){

    			$sql = 'UPDATE wp_operations SET nombre="'.$name.'", estado='.$estado.', NIV="'.$niv.'", fecha="'.$date.'", descripcion="'.$description.'"  WHERE id=' . $idOpe;


				if ($conn->query($sql) === TRUE) {

					$_SESSION['error'] = "Operación modificada correctamente."; 
				}else{

					$result=2;
					$_SESSION['error'] = "ERROR: No se ha podido actualizar.";					
				}		

				
    		}

    	}else{

			$result=2;
			$_SESSION['error'] = "ERROR: El nombre de la operación no puede estar vacio."; 
    	}		

	}  


    $conn->close();	


    header("Location:" . URL_RESULT . "?result=" . $result);
	exit();
?>
