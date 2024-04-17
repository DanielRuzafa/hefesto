<?php
    if(!session_id()){
        session_start();
    }

	require_once('../../../../wp-config.php');
	require_once('../../../../wp-blog-header.php');
	require_once('../../../../wp-includes/user.php');


    //define("URL_RESULT", "http://".$_SERVER['HTTP_HOST'] . "/ioc/");
    define("URL_RESULT", "http://".$_SERVER['HTTP_HOST'] . "/hefesto/ioc/");
    
	$result=1;

	// Create connection
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$conn->set_charset("utf8");

	if(isset($_POST['idOpe'])){
		$idOpe = $_POST['idOpe'];
	}else{
		$result = 2;
		
	}

	if(isset($_POST['idIOC'])){
		$idIOC = $_POST['idIOC'];
	}else{
		$result = 2;
		
	}



	if(isset($_POST['importSubmit'])){

		if(isset($_POST['entity'])){
			$entity = $_POST['entity'];
		}else{
			$result = 2;
			
		}

		if(isset($_POST['value'])){
			$value = cleanupentries($_POST['value']);
		}else{
			$result = 2;
			
		}

		if(isset($_POST['provider'])){
			$provider = cleanupentries($_POST['provider']);

		}else{
			$result = 2;

		}


		if(isset($_POST['siena'])){
			$siena = cleanupentries($_POST['siena']);
		}else{
			$result = 2;
			
		}

		if(isset($_POST['date'])){
			$date = formatDate($_POST['date']);
		}else{
			$result = 2;
			
		}

		if(isset($_POST['dateIni'])){
			$dateIni = formatDate($_POST['dateIni']);
		}else{
			$result = 2;
			
		}

		if(isset($_POST['dateFin'])){
			$dateFin = formatDate($_POST['dateFin']);
		}else{
			$result = 2;
			
		}


		if(isset($_POST['victim'])){
			$victim = cleanupentries($_POST['victim']);
		}else{
			$result = 2;
			
		}

		if(isset($_POST['description'])){
			$description = cleanupentriesDesc($_POST['description']);
		}else{
			$result = 2;
			
		}
		if(isset($_POST['task'])){
			$task = cleanupentriesDesc($_POST['task']);
		}else{
			$result = 2;
			
		}

    	//Comprobamos si el valor del IOC no esta vacio
    	if($value!=""){

    		//Comprobamos que el IOC no ha sido subido para la misma investigacion
    		if(!checkIOC($value, $idOpe)){


                $sql = 'UPDATE wp_ioc SET entity="'. $entity .'", value="'.$value.'", description="'.$description.'", provider="'.$provider.'", task="'.$task.'", siena="'.$siena.'", data_occurrence="'.$date.'", data_start="'.$dateIni.'", data_end="'.$dateFin.'", victim="'.$victim.'" WHERE idOperation=' . $idOpe . ' AND id=' . $idIOC;

				if ($conn->query($sql) === TRUE) {

					$_SESSION['error'] = "IOC actualizado correctamente.";
				}else{

					$result=2;
					$_SESSION['error'] = "ERROR: No se ha podido actualizar.";					
				}				

				
    		}

    	}else{

			$result=2;
			$_SESSION['error'] = "ERROR: El valor del IOC no puede estar vacio."; 
    	}		

	}  


    $conn->close();	


    header("Location:" . URL_RESULT . "?result=" . $result);
	exit();
?>
