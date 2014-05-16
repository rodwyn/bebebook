<?php
/** *              
 *  @name                Script que muestra los datos de un perfil
 *  @copyright           Air Logistics & GPS S.A. de C.V.   
 *  @author              Rodwyn Moreno
 *  @modificado          27/03/13
**/
	header('Content-Type: text/html; charset=UTF-8');
	$db = new sql($config_bd['host'],$config_bd['port'],$config_bd['bname'],$config_bd['user'],$config_bd['pass']);
	if(!$userAdmin->u_logged())
		echo '<script>window.location="index.php?m=login"</script>';	
		
	$db ->sqlQuery("SET NAMES 'utf8'");
	
	
	$host = $config_bd['host'];
	$user = $config_bd['user'];
	$pass = $config_bd['pass'];
	$bd = $config_bd['bname'];
	
	$tpl->set_filenames(array('mFormulario' => 'tFormulario'));
	$opt="";
	$s="";
	$data = $dbf->getRow('TBL_HISTORIA','ID = '.$_GET['id']);
	
	/*$sql = "SELECT * FROM TBL_CONTACTO ORDER BY ID ";
			$qry = $db->sqlQuery($sql);
			$cnt = $db->sqlEnumRows($qry);
			if($cnt>0){
				while($row = $db->sqlFetchArray($qry)){
					$pos = strpos(@$data['ID_PAIS'], $row['ID']);
					$s = ($pos === false)?'':'selected="selected"';
					
					$opt .= '<option value="'.$row['ID'].'" '.$s.'>'.$row['PAIS_ES'].'</option>';
					}
				
				}*/
	
	
	//``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``, ``
	
	//$img =  (@$data['IMAGEN'] != "")?"public/producto/".@$data['IMAGEN']:'public/producto/Sin_imagen_disponible .jpg';
	
	//$opt= @$data['ID_PATRON_MEDIDA'];
	
	
	$tpl->assign_vars(array(
	'CTE'		=> $cte,
	'HOST'		=> $host,
	'USER'		=> $user,
	'PASS'		=> $pass,
	'DB'		=> $bd,
	'ID'      	=> $_GET['id'],
	'OP'		=> $_GET['op'],
	
	
	//'OPT'		=> $opt,
	
	'TTL' =>  @$data['TITULO'],
	'TXT' =>  @$data['TEXTO'],
	'DTE' =>  @$data['FECHA']
	));
	$tpl->pparse('mFormulario');	
	/*function get_id($pat){
		if($pat!=""){
			global $db;
			$sql = "SELECT ID_UNIDAD_MEDIDA FROM PED_PATRON_MEDIDA WHERE ID_PATRON_MEDIDA = ".$pat;
			$qry = $db->sqlQuery($sql);
			$cnt = $db->sqlEnumRows($qry);
			if($cnt>0){
				$row = $db->sqlFetchArray($qry);
				return $row['ID_UNIDAD_MEDIDA'];
				}
			else{
				return -1;
				}				
			}
		else{
			return -1;
			}
		}*/
?>	