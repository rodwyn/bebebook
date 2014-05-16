<?php
/* 
 *  @package             
 *  @name                Controla las solicitudes de la pagina
 *  @version             1
 *  @copyright           Air Logistics & GPS S.A. de C.V.   
 *  @author              Enrique Peña 
 *  @modificado          13/04/2011
**/
	$config_bd = array(
		'port'  => '3306',			        //Puerto de la base de datos
		'host'  => 'localhost',		        //Host o ip donde se ubica la base de datos
		'bname' => 'bebebook',	//Nombre  de la base de datos
		//servidor foraneo
		//'user' 	=> 'a5533605_if',			        //usuario de la base de datos 
		//'pass' 	=> 'a123456'			        //Contraseña de la base de datos
		//servidor local
		'user' 	=> 'fund_int',			        //usuario de la base de datos 
		'pass' 	=> 'u8yQMjqjDJ67Tn5Q'	
	);
	$config_bd_sp = array(
		'port'  => '3306',			        //Puerto de la base de datos
		'host'  => 'localhost',		        //Host o ip donde se ubica la base de datos
		'bname' => 'ALG_BD_SP',	//Nombre  de la base de datos
		//servidor foraneo
		//'user' 	=> 'savl',			        //usuario de la base de datos 
		//'pass' 	=> '397LUP'			        //Contraseña de la base de datos
		//servidor local
		'user' 	=> 'root',			        //usuario de la base de datos 
		'pass' 	=> 'alg'	
	);	
		
		$config_bd3 = array(
		'port'  => '3306',			//Puerto de la base de datos
		'host'  => 'localhost',		//Host o ip donde se ubica la base de datos
		'bname' => 'ALG_BD_CORPORATE_ALERTAS_MOVI',	//Nombre  de la base de datos
		'user' 	=> 'savl',			//usuario de la base de datos 
		'pass' 	=> '397LUP'			//Contraseña de la base de datos
	);
?>
