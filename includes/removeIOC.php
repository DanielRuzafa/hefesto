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

        //Comprobamos si la operacion existe
        if(checkIOCExist($idIOC)){
            $sql = 'DELETE FROM wp_ioc WHERE id='. $idIOC;
      
			if ($conn->query($sql) === TRUE) {

				$_SESSION['error'] = "IOC eliminado correctamente.";
			}else{

				$result=2;
				$_SESSION['error'] = "ERROR: No se ha podido eliminar.";					
			}	                 
        
        }else{
			$result=2;
			$_SESSION['error'] = "ERROR: EL IOC que desea eliminar no existe.";	        	
        }		



	}  


    $conn->close();	


    header("Location:" . URL_RESULT . "?result=" . $result);
	exit();
?>
