<?php
    if(!session_id()){
        session_start();
    }

	require_once('../../../../wp-config.php');
	require_once('../../../../wp-blog-header.php');
	require_once('../../../../wp-includes/user.php');

	// Include PhpSpreadsheet library autoloader 
	require_once '../PhpSpreadsheet/vendor/autoload.php'; 
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 

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

	if(isset($_POST['idUsu'])){
		$idUsu = $_POST['idUsu'];
	}else{
		$result = 2;
		
	}


	//Variable que nos dice como se inserta el IOC
	// tipeForm=1 ---> Desde Fichero
	// tipeForm=2 ---> Desde Lineas

	if(isset($_POST['tipeForm'])){
		$tipeForm = $_POST['tipeForm'];
	}else{
		$result = 2;
		
	}

	if((isset($_POST['importSubmit']))&&($tipeForm==1)){ 


	    // Allowed mime types 
	    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
	     
	    // Validate whether selected file is a Excel file 
	    if(!empty($_FILES['fileToUpload']['name']) && in_array($_FILES['fileToUpload']['type'], $excelMimes)){ 
	         
	        // If the file is uploaded 
	        if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])){ 
	            $reader = new Xlsx(); 
	            $spreadsheet = $reader->load($_FILES['fileToUpload']['tmp_name']); 
	            $worksheet = $spreadsheet->getActiveSheet();  
	            $worksheet_arr = $worksheet->toArray(); 
	 
	            // Remove header row 
	            unset($worksheet_arr[0]); 
	 

	            foreach($worksheet_arr as $row){
	            	$entity = $row[0]; 
	                $value = $row[1]; 
	                $description = $row[2]; 
	                $provider = $row[3]; 
	                $task = $row[4]; 
	                $siena = $row[5]; 
	                $data_occurrence = $row[6]; 
	                $data_start = $row[7]; 
	                $data_end = $row[8]; 
	                $victim = $row[9]; 


	            	//Comprobamos si el valor del IOC no esta vacio
	            	if($value!=""){

	            		//Comprobamos que el IOC no ha sido subido para la misma investigacion
	            		if(!checkIOC($value, $idOpe)){


			                //Creamos la entrada
			                $sql = 'INSERT INTO wp_ioc (idOperation, idUsu, entity, value, description, provider, task, siena, data_occurrence, data_start, data_end, victim)
			                 VALUES ( '.$idOpe.', '.$idUsu.', "'. $entity .'" , "'.$value.'", "'.$description.'", "'.$provider.'", "'.$task.'", "'.$siena.'", "'.$data_occurrence.'", "'.$data_start.'", "'.$data_end.'", "'.$victim.'" )';

			                //La insertamos
							$conn->query($sql);	  

	            		}

	            	}

	            } 
	             
				$_SESSION['error'] = "Fichero tratado correctamente.";

	        }else{ 
				$result=2;
				$_SESSION['error'] = "ERROR: No se ha subido el fichero."; 

	        } 
	    }else{ 
			$result=2;
			$_SESSION['error'] = "ERROR: Fichero invalido";
	    } 

	}elseif((isset($_POST['importSubmit']))&&($tipeForm==2)){

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


                //Creamos la entrada
                $sql = 'INSERT INTO wp_ioc (idOperation, idUsu, entity, value, description, provider, task, siena, data_occurrence, data_start, data_end, victim)
                 VALUES ( '.$idOpe.', '.$idUsu.', "'. $entity .'" , "'.$value.'", "'.$description.'", "'.$provider.'", "'.$task.'", "'.$siena.'", "'.$date.'", "'.$dateIni.'", "'.$dateFin.'", "'.$victim.'" )';

                //La insertamos
				$conn->query($sql);

				$_SESSION['error'] = "Fichero tratado correctamente.";
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
