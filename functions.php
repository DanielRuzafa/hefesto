<?php
    /********************************* START AJAX SECTION*/
    wp_enqueue_script('jquery');
    add_action('wp_ajax_nopriv_removeUser', 'removeUser');
    add_action('wp_ajax_removeUser', 'removeUser');

    function removeUser(){
        $idUsu= $_POST['idUser'];



        $result = deleteUser($idUsu);



        echo json_encode($result);      
        wp_die();  
    }

    add_action('wp_ajax_nopriv_getIOCByOP', 'getIOCByOP');
    add_action('wp_ajax_getIOCByOP', 'getIOCByOP');

    function getIOCByOP(){
        $idOpe= $_POST['idOpe'];



        $result = getIOCByOperation($idOpe);



        echo json_encode($result);      
        wp_die();  
    }

    add_action('wp_ajax_nopriv_removeOp', 'removeOp');
    add_action('wp_ajax_removeOp', 'removeOp');

    function removeOp(){
        $idOp= $_POST['idOp'];



        $result = deleteOperation($idOp);



        echo json_encode($result);      
        wp_die();  
    }

    add_action('wp_ajax_nopriv_changeStateOP', 'changeStateOP');
    add_action('wp_ajax_changeStateOP', 'changeStateOP');

    function changeStateOP(){
        $idOp= $_POST['idOp'];
        $state= $_POST['state'];


        $result = changeStateOperation($idOp, $state);


        echo json_encode($result);      
        wp_die();  
    }


    add_action('wp_ajax_nopriv_getMembersByOpe', 'getMembersByOpe');
    add_action('wp_ajax_getMembersByOpe', 'getMembersByOpe');

    function getMembersByOpe(){
        $idOpe= $_POST['idOpe'];



        $result = getMembersByOperation($idOpe);



        echo json_encode($result);      
        wp_die();  
    }

    add_action('wp_ajax_nopriv_activeUser', 'activeUser');
    add_action('wp_ajax_activeUser', 'activeUser');

    function activeUser(){
        $idUsu= $_POST['idUsu'];

        $result = true;
        setActiveMember($idUsu);

        echo json_encode($result);      
        wp_die();  
    }

	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

	// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar',
    		'id'   => 'sidebar',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

    //Hide admin edit bar on front end. It's annoying!
    show_admin_bar( false );

    //Add support for featured images
    add_theme_support( 'post-thumbnails' );


    //Activamos la sesion
    function register_my_session()
    {
      if( !session_id() )
      {
        session_start();
      }
    }

    add_action('init', 'register_my_session');

    function get_images($size = 'thumbnail')
    {
        global $post;
        return get_children(array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID'));
    }

    function se_body_page_name_class( $classes ) {
        global $post;
            $classes[] = $post->post_name;
        return $classes;
    }
    add_filter('body_class', 'se_body_page_name_class');

    function nav_menu_add_classes( $items, $args ) {
        //Add first item class
        $items[1]->classes[] = 'menu-item-first';

        //Add last item class
        $i = count($items);
        while($items[$i]->menu_item_parent != 0 && $i > 0) {
            $i--;
        }
        $items[$i]->classes[] = 'menu-item-last';

        return $items;
    }
    add_filter( 'wp_nav_menu_objects', 'nav_menu_add_classes', 10, 2 );

    function add_slug_class_to_menu_item($output){
        $ps = get_option('permalink_structure');
        if(!empty($ps)){
            $idstr = preg_match_all('/<li id="menu-item-(\d+)/', $output, $matches);
            foreach($matches[1] as $mid){
                $id = get_post_meta($mid, '_menu_item_object_id', true);
                $slug = basename(get_permalink($id));
                $output = preg_replace('/menu-item-'.$mid.'">/', 'menu-item-'.$mid.' menu-item-'.$slug.'">', $output, 1);
            }
        }
        return $output;
    }
    add_filter('wp_nav_menu', 'add_slug_class_to_menu_item');

    function short_text($str, $len = 80) {
        $str = strip_tags($str);

        if(strlen($str) > $len) {
            echo substr($str,0,$len-3)."...";
        }else{
            echo $str;
        }
    }

    function get_setting($var, $default="#", $echo=true) {

        $setting = get_option($var);

        if($setting) {
            if($echo) {
                return $setting;
            }else{
                return $setting;
            }
        }else{
            if($echo) {
                return $default;
            }else{
                return $default;
            }
        }

    }






function add_testimonial_caps_to_admin() {
  $caps = array(
    'read',
    'read_anuncios',
    'read_private_anuncios',
    'edit_anuncios',
    'edit_private_anuncios',
    'edit_published_anuncios',
    'edit_others_anuncios',
    'publish_anuncios',
    'delete_anuncios',
    'delete_private_anuncios',
    'delete_published_anuncios',
    'delete_others_anuncios',
  );
  $roles = array(
    get_role( 'subscriber' )

  );
  foreach ($roles as $role) {
    foreach ($caps as $cap) {
      $role->add_cap( $cap );
    }
  }
}
add_action( 'after_setup_theme', 'add_testimonial_caps_to_admin' );

    //Limpiamos entradas para prevenir inyeccion de sql
    function cleanupentries($entry) {
        $entry = trim($entry);

 
      // Using str_replace() function 
      // to replace the word 
      $res = str_replace( array( '\'', '"', ',', ';', '<', '>', ' ', '?', '¿', '*', '%', '&', '$', '/', '\\', '=', '-', '_', '|', '@', '·' ), '', $entry);
 


        return $res;
    }


    //Limpiamos entradas para prevenir inyeccion de sql para descripcion
    function cleanupentriesDesc($entry) {
        $entry = trim($entry);

 
      // Using str_replace() function 
      // to replace the word 
      $res = str_replace( array( '\'', ';', '<', '>', '*', '%', '&', '$', '\\', '=', '|', '·' ), '', $entry);
 


        return $res;
    }


    //Obtenemos los id's de los miembros
    function getIdMembers($idAdministrador){
        global $wpdb;
        
        $result= array();

        $sql = 'SELECT idUsu FROM wp_members_group WHERE idAdmin='. $idAdministrador; 

        $aux = $wpdb->get_results($sql);

        foreach ($aux as $item) {
                $result[] = $item->idUsu;
            }    

        return $result;
    }

    //Obtenemos el listado de usuarios
    function getUsers($idAdministrador){
        global $wpdb;

        //Recuperamos solo los users de un administrador
        $membersIds = getIdMembers($idAdministrador);

        $args = array(
            'role'         => 'subscriber',
            'include'      => $membersIds,
            'orderby'      => 'ID',
            'order'        => 'ASC'
         ); 
        $users= get_users($args);
    

        foreach ($users as $usu) {

            $id = $usu->ID;
            $display_name = $usu ->display_name;
            $email = $usu ->user_email;


            //Usuario principal
            $results[]= '<tr class="usuarioLine">';

            $sql = 'SELECT * FROM wp_members_group WHERE idUsu =' . $id;
            $aux = $wpdb->get_results($sql);

            $sql = 'SELECT * FROM wp_members_details WHERE idUsu =' . $id;
            $aux2= $wpdb->get_results($sql);

            if(isset($aux2[0]->cp)){
                $cp = $aux2[0]->cp;
            }else{
                $cp="";
            }

            if(isset($aux2[0]->telefono)){
                $telefono = $aux2[0]->telefono;
            }else{
                $telefono="";
            }            
            
            $results[].="<td>" . $display_name . "</td>";
            $results[].="<td>" . $email . "</td>";
            $results[].="<td>" . $cp . "</td>";
            $results[].="<td>" . $telefono . "</td>";

            if($aux[0]->activo==0){
                $results[].='<td id="'.$usu->ID.'" class="red activeButton"><i class="far fa-times-circle"></i></td>';
                
            }else{
                $results[].='<td id="'.$usu->ID.'" class="green"><i class="far fa-check-circle"></i></td>';
            }

            $results[] = '<td><span id="'.$usu->ID.'" class="link">Eliminar usuario</span></td>';

            $results[].= "</tr>"; 
        }
        return $results; 

    }

    //Obtenemos el listado de IOCS
    function getIOCs(){
        global $wpdb;

        //Recuperamos solo los users de un administrador
        $membersIds = getIdMembers($idAdministrador);

        $args = array(
            'role'         => 'subscriber',
            'include'      => $membersIds,
            'orderby'      => 'ID',
            'order'        => 'ASC'
         ); 
        $users= get_users($args);
    

        foreach ($users as $usu) {

            $id = $usu->ID;
            $display_name = $usu ->display_name;
            $email = $usu ->user_email;


            //Usuario principal
            $results[]= '<tr class="usuarioLine">';

            $sql = 'SELECT * FROM wp_members_group WHERE idUsu =' . $id;
            $aux = $wpdb->get_results($sql);

            $sql = 'SELECT * FROM wp_members_details WHERE idUsu =' . $id;
            $aux2= $wpdb->get_results($sql);

            if(isset($aux2[0]->cp)){
                $cp = $aux2[0]->cp;
            }else{
                $cp="";
            }

            if(isset($aux2[0]->telefono)){
                $telefono = $aux2[0]->telefono;
            }else{
                $telefono="";
            }            
            
            $results[].="<td>" . $display_name . "</td>";
            $results[].="<td>" . $email . "</td>";
            $results[].="<td>" . $cp . "</td>";
            $results[].="<td>" . $telefono . "</td>";

            if($aux[0]->activo==0){
                $results[].='<td id="'.$usu->ID.'" class="red activeButton"><i class="far fa-times-circle"></i></td>';
                
            }else{
                $results[].='<td id="'.$usu->ID.'" class="green"><i class="far fa-check-circle"></i></td>';
            }

            $results[] = '<td><span id="'.$usu->ID.'" class="link">Eliminar usuario</span></td>';

            $results[].= "</tr>"; 
        }
        return $results; 

    }

    //Comprobamos si existen datos del miembro del grupo
    function checkMembersDetails($idUsu){
        global $wpdb;

        $sql = 'SELECT * FROM wp_members_details WHERE id =' . $idUsu; 

        $aux = $wpdb->get_results($sql);

        if(empty($aux)){
            return false;
        }else{
            return true;
        }        
    }

    //Comprobamos si el miembro esta relacionado con un admin
    function checkMembersGroup($idUsu){
        global $wpdb;

        $sql = 'SELECT * FROM wp_members_group WHERE idUsu =' . $idUsu; 

        $aux = $wpdb->get_results($sql);

        if(empty($aux)){
            return false;
        }else{
            return true;
        }        
    }





    //Borramos Usuario
    function deleteUser($id){
        global $wpdb;
        $result=false;


        
        if(checkMembersDetails($id)){
            $sql = 'DELETE FROM wp_members_details WHERE idUsu='. $id;
            $wpdb->query($sql);
        }

        if(checkMembersGroup($id)){
            $sql1 = 'DELETE FROM wp_members_group WHERE idUsu='. $id;
            $wpdb->query($sql1);
        }



        wp_delete_user($id);

        $result= true;

        return $result;    
    }

    //Borramos Operacion
    function deleteOperation($idOp){
        global $wpdb;
        $result=false;


        //Comprobamos si tiene IOC
        if(checkOperationsIOC($idOp)){
            $sql1 = 'DELETE FROM wp_ioc WHERE idOperation='. $idOp;
            $wpdb->query($sql1);            
        }
        //Comprobamos si esta relacionada con miembros
        if(checkOperationsMembers($idOp)){
            $sql1 = 'DELETE FROM wp_members_operations WHERE idOperation='. $idOp;
            $wpdb->query($sql1);            
        }
        //Comprobamos si la operacion existe
        if(checkOperationsExist($idOp)){
            $sql1 = 'DELETE FROM wp_operations WHERE id='. $idOp;
            $wpdb->query($sql1);            
        }

        $result= true;

        return $result;    
    }



    //Activamos el usuario
    function setActiveMember($id){
        global $wpdb;
        

        $sql = 'UPDATE wp_members_group SET activo=1 WHERE idUsu=' . $id;
        
        $wpdb->query($sql);

        $user = get_user_by( 'id', $id );

        /*
        //Email con los datos de acceso registro
        $f_email = "info@hefesto.com";
        
        $send_subject = "Usuario activado Control Calidad SEC";
        $headers = "From: " . $f_email . "\r\n" .
            "Reply-To: " . $f_email . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        $send_to = $user->user_email;

        $message = "Hola! " .$user->first_name . ", " . "\r\n" ." se ha activado tu cuenta correctamente. " . "\r\n" . "Ya puedes acceder a la plataforma de Control de Calidad de la SEC. ";

        $message = utf8_decode($message);
        //$send_subject .= " - {$name}";


        mail($send_to, $send_subject, $message, $headers); */
        
  
    }

    //Comprobamos si el miembro esta activado
    function getActivatedMember($id){
        global $wpdb;

        $sql = 'SELECT activo FROM wp_members_group WHERE idUsu =' . $id; 

        $aux = $wpdb->get_results($sql);

        if($aux[0]->activo == 0){
            return false;
        }else{
            return true;
        }   
                 
    }

    //Devolvemos las operaciones del grupo
    function getOperations(){
        global $wpdb;
        
        $result= array();

        $sql = 'SELECT * FROM wp_operations'; 

        $aux = $wpdb->get_results($sql);
        $result[]='<option selected disabled>Seleccione operacion...</option>';
        foreach ($aux as $item) {
                $result[] = '<option id=ope'. $item->id.' value='. $item->id.'>'.$item->nombre.'</option>';
            }    

        return $result;        
    }


    //Devolvemos los miembros de una operacion
    function getMembersByOperation($idOpe){
        global $wpdb;
        
        $result= array();

        $sql = 'SELECT * FROM wp_members_operations WHERE idOperation = '.$idOpe; 

        $aux = $wpdb->get_results($sql);
        $result[]='<option selected disabled>Seleccione operacion...</option>';
        foreach ($aux as $item) {

                $aux1= get_user_by('id', $item->idUsu);
                $result[] = '<option id=usu'. $item->idUsu.' value='. $item->idUsu.'>'. $aux1->first_name . ' ' . $aux1->last_name.'</option>';
            }    

        return $result;        
    }

    //Devolvemos los miembros de parte de un equipo
    function getMembersByAdmin($idAdmin){
        global $wpdb;
        
        $result= array();

        $sql = 'SELECT * FROM wp_members_group WHERE idAdmin = '.$idAdmin; 

        $aux = $wpdb->get_results($sql);
        $result[]='<option selected disabled>Seleccione miembro del equipo...</option>';
        foreach ($aux as $item) {

                $aux1= get_user_by('id', $item->idUsu);
                $result[] = '<option id=usu'. $item->idUsu.' value='. $item->idUsu.'>'. $aux1->first_name . ' ' . $aux1->last_name.'</option>';
            }    

        return $result;        
    }

    //Devolvemos los miembros de parte de un equipo y el asignado marcado
    function getMembersByAdminSelected($idAdmin, $idOpe){
        global $wpdb;
        
        $result= array();

        $sql = 'SELECT * FROM wp_members_group WHERE idAdmin = '.$idAdmin; 
        $aux = $wpdb->get_results($sql);        

        $sql1 = 'SELECT idUsu FROM wp_members_operations WHERE idOperation = '.$idOpe; 
        $aux2 = $wpdb->get_results($sql1);


        $result[]='<option disabled>Seleccione miembro del equipo...</option>';
        foreach ($aux as $item) {

                $aux1= get_user_by('id', $item->idUsu);

                if($aux2[0]->idUsu==$item->idUsu){
                    $result[] = '<option id=usu'. $item->idUsu.' value='. $item->idUsu.' selected>'. $aux1->first_name . ' ' . $aux1->last_name.'</option>';
                }else{
                    $result[] = '<option id=usu'. $item->idUsu.' value='. $item->idUsu.'>'. $aux1->first_name . ' ' . $aux1->last_name.'</option>';                    
                }
            }    

        return $result;        
    }


    //Comprobamos que el IOC no ha sido subido para la misma investigacion
    function checkIOC($value, $idOpe){

        global $wpdb;

        $sql = 'SELECT * FROM wp_ioc WHERE idOperation =' . $idOpe . ' AND value='. $value; 

        $aux = $wpdb->get_results($sql);   

        if(empty($aux)){
            $result=false;
        }else{
            $result = true;
        }
        
        return $result;
    } 

    //Comprobamos que el nombre no esta repetido en ninguna operación
    function checkNameOP($name){

        global $wpdb;

        $sql = 'SELECT * FROM wp_operations WHERE nombre ="' . $name . '"'; 

        $aux = $wpdb->get_results($sql);   

        if(empty($aux)){
            $result=false;
        }else{
            $result = true;
        }
        
        return $result;
    }  

    //Comprobamos que el nombre no esta repetido en ninguna operación
    function checkNameOPEdited($name, $idOpe){

        global $wpdb;

        $sql = 'SELECT * FROM wp_operations WHERE nombre ="' . $name . '" AND id<>'.$idOpe; 

        $aux = $wpdb->get_results($sql);   

        if(empty($aux)){
            $result=false;
        }else{
            $result = true;
        }
        
        return $result;
    }    


    //Creamos una funcion para formatear las fechas
    function formatDate($date){

        $aux = explode("-", $date);

        if($aux[0]==$date){
            $result=$date;
        }else{
            $result=$aux[2] . '/' . $aux[1] . '/' . $aux[0];
        }
        
        

        return $result;
    }


   //Obtenemos toda la informacion de un usuario
    function getUserInfoComplete($id){
        global $wpdb;

        $user = get_user_by( 'ID', $id);

        $result[]=$user->first_name;
        $result[]=$user->user_email;

        $sql = 'SELECT * FROM wp_members_details WHERE idUsu =' . $id;
        $aux = $wpdb->get_results($sql);

        if(empty($aux)){
            $result[] = "";
            $result[] = "";
        }else{
            $result[] = $aux[0]->cp;
            $result[] = $aux[0]->telefono;            
        }



        return $result;
    }


    //Comprobamos si un miembro ya tiene detalles guardados
    function checkMemberDetails($idUsu){
        global $wpdb;

        $sql = 'SELECT * FROM wp_members_details WHERE idUsu =' . $idUsu; 

        $aux = $wpdb->get_results($sql);

        if(empty($aux)){
            return false;
        }else{
            return true;
        }          
    }

    //Comprobamos si hay operaciones activas
    function checkOperationsByState($estado){
        global $wpdb;

        $sql = 'SELECT * FROM wp_operations WHERE estado = ' . $estado; 
        
        $aux = $wpdb->get_results($sql);    


        if(empty($aux)){
            return false;
        }else{
            return true;
        }          
    }

    //Comprobamos si la operacion tiene ioc
    function checkOperationsIOC($idOp){
        global $wpdb;

        $sql = 'SELECT * FROM wp_ioc WHERE idOperation = ' . $idOp; 
        
        $aux = $wpdb->get_results($sql);    


        if(empty($aux)){
            return false;
        }else{
            return true;
        }          
    }

    //Comprobamos si la operacion esta relacionada con members
    function checkOperationsMembers($idOp){
        global $wpdb;

        $sql = 'SELECT * FROM wp_members_operations WHERE idOperation = ' . $idOp; 
        
        $aux = $wpdb->get_results($sql);    


        if(empty($aux)){
            return false;
        }else{
            return true;
        }          
    }

    //Comprobamos si la operacion existe
    function checkOperationsExist($idOp){
        global $wpdb;

        $sql = 'SELECT * FROM wp_operations WHERE id = ' . $idOp; 
        
        $aux = $wpdb->get_results($sql);    


        if(empty($aux)){
            return false;
        }else{
            return true;
        }          
    }

    //Comprobamos si el IOC existe
    function checkIOCExist($idIOC){
        global $wpdb;

        $sql = 'SELECT * FROM wp_ioc WHERE id='. $idIOC; 
        
        $aux = $wpdb->get_results($sql);    


        if(empty($aux)){
            return false;
        }else{
            return true;
        }          
    }


    //Listamos las operaciones del grupo de investigación
    function getOperationsByState($estado, $rolUser){
        global $wpdb;

        //$url = "http://".$_SERVER['HTTP_HOST'] . "/operaciones/editar";
        $url = "http://".$_SERVER['HTTP_HOST'] . "/hefesto/operaciones/editar";

        $results= array();

        $sql = 'SELECT * FROM wp_operations WHERE estado = ' . $estado; 
        
        $operations = $wpdb->get_results($sql);    

        if(!empty($operations)){
            
            
            
            foreach($operations as $item){
                $nameResponsable = getResponsable($item->id);

                $results[]= '<tr class="opLine">';
                $results[].="<td>" . $item->nombre . "</td>";
                $results[].="<td>" . $item->NIV . "</td>";
                $results[].="<td>" . $item->fecha . "</td>";
                $results[].="<td>" . $nameResponsable . "</td>";


                if($rolUser=="administrator"){
                    $results[].='<td><a href="'. $url . '?aux='.$item->id.'"><i class="fa-solid fa-pen-to-square" title="Editar"></i></a></td>';

                    $results[].= '<td><span id="'.$item->id.'" class="link"><i class="fa-solid fa-trash" title="Elminar"></i></span></td>';
                 
                }
                $results[].= "</tr>"; 
            }

                    

        
        }

        return $results; 
    }


    //Devolvemos la operación a partir de su ID
    function getOperationByID($idOp){
        global $wpdb;


        $results= array();

        $sql = 'SELECT * FROM wp_operations WHERE id = ' . $idOp; 
        
        $operations = $wpdb->get_results($sql);    

        return $operations; 
    }

    //Devolvemos ioc a partir de su ID
    function getIOCByID($id){
        global $wpdb;


        $sql = 'SELECT * FROM wp_ioc WHERE id = ' . $id; 
        
        $iocs = $wpdb->get_results($sql);    

        return $iocs; 
    }


    //Devolvemos responsable operacion
    function getResponsable($idOpe){

        global $wpdb;



        $sql = 'SELECT idUsu FROM wp_members_operations WHERE idOperation =' . $idOpe; 

        $aux = $wpdb->get_results($sql);

        if(empty($aux)){
            $result="-";
        }else{
            $user = get_user_by( 'ID', $aux[0]->idUsu);

            $result=$user->first_name . " " . $user->last_name;            
        }

        return $result;
    }


    //Cambiamos el estado de una operacion
    function changeStateOperation($idOp, $state){
        global $wpdb;

        if($state==1){
            $sql = 'UPDATE wp_operations SET estado=0 WHERE id=' . $idOp;
        }else{
            $sql = 'UPDATE wp_operations SET estado=1 WHERE id=' . $idOp;
        }

        $wpdb->query($sql);

        return true;

    }


    //REcuperamos los IOCS en base a una operacion
    function getIOCByOperation($idOp){
        global $wpdb;
        //$url = "http://".$_SERVER['HTTP_HOST'] . "/ioc/editar";
        $url = "http://".$_SERVER['HTTP_HOST'] . "/hefesto/ioc/editar";


        $sql = 'SELECT * FROM wp_ioc WHERE idOperation = ' . $idOp; 
        
        $iocs = $wpdb->get_results($sql);  

        if(!empty($iocs)){
            
            
            
            foreach($iocs as $item){
                

                $results[]= '<tr class="iocLine">';
                $results[].="<td>" . $item->entity . "</td>";
                $results[].="<td>" . $item->value . "</td>";
                $results[].="<td>" . $item->description . "</td>";
                $results[].="<td>" . $item->provider . "</td>";
                $results[].="<td>" . $item->task . "</td>";
                $results[].="<td>" . $item->siena . "</td>";
                $results[].="<td>" . $item->data_occurrence . "</td>";
                $results[].="<td>" . $item->data_start . "</td>";
                $results[].="<td>" . $item->data_end . "</td>";
                $results[].="<td>" . $item->victim . "</td>";
                $results[].='<td><a href="'. $url . '?aux='.$item->id.'"><i class="fa-solid fa-pen-to-square" title="Editar"></i></a></td>';

                $results[].= "</tr>"; 
            }

                     

        
        }

        return $results; 
    }

    //REcuperamos los IOCS en base a una operacion
    function getIOCByOperationID($idOp){
        global $wpdb;

        $results=array();

        $sql = 'SELECT * FROM wp_ioc WHERE idOperation = ' . $idOp; 
        
        $iocs = $wpdb->get_results($sql);  

        if(!empty($iocs)){
            
            
            
            foreach($iocs as $item){
                

                $results[]= '<tr class="usuarioLine">';
                $results[].="<td>" . $item->entity . "</td>";
                $results[].="<td>" . $item->value . "</td>";
                $results[].="<td>" . $item->description . "</td>";
                $results[].="<td>" . $item->provider . "</td>";
                $results[].="<td>" . $item->task . "</td>";
                $results[].="<td>" . $item->siena . "</td>";
                $results[].="<td>" . $item->data_occurrence . "</td>";
                $results[].="<td>" . $item->data_start . "</td>";
                $results[].="<td>" . $item->data_end . "</td>";
                $results[].="<td>" . $item->victim . "</td>";
                $results[].= "</tr>"; 
            }        
        }

        return $results; 
    }

    //Devolvemos las operaciones del grupo listadas
    function getOperationsList(){
        global $wpdb;
        

        $sql = 'SELECT * FROM wp_operations'; 

        $aux = $wpdb->get_results($sql);


        return $aux;        
    }





?>