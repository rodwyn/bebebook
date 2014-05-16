<?php
/** * 
 *  @package             
 *  @name                Pagina default del modulo silver 
 *  @version             1
 *  @copyright           Air Logistics & GPS S.A. de C.V.   
 *  @author              Rodwyn Moreno
 *  @modificado          23-04-2012
**/
header("Expires: Mon, 20 Mar 1998 12:01:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once('libs/dbFunctions.php');

 
$db = new sql($config_bd['host'],$config_bd['port'],$config_bd['bname'],$config_bd['user'],$config_bd['pass']);
if(!$userAdmin->u_logged())
	echo '<script>window.location="index.php?m=login"</script>';
			
$db ->sqlQuery("SET NAMES 'utf8'");	

$dbf = new dbFunctions();

$data = Array(
//``, ``, ``, `IMAGEN`, ``
		'ID_USER'		=> $userAdmin->user_info['ID_USUARIO'],
		'TITULO'		=> $_POST['hst_ttl'],
		'TEXTO' 		=> $_POST['hst_txt'],
		'FECHA' 		=> $_POST['datepicker']
		);

  

$mns="";

if($_POST['hst_hop']==1){
	if($dbf-> insertDB($data,'TBL_HISTORIA',true) == true){
		$mns .= "Los datos fueron registrados exitosamente.";
		$id = last_id();
		$x = explode("/",$_FILES['hst_img']['type']);
		$nm = "hst_".$id.".".$x[1];
		if ($_FILES["hst_img"]["error"] > 0){
			$mns .= "Sin imagen asociada.";
			}
		else{
			guardar_imagen($nm,$id);
			}
		}
	else{

		$mns .= "Los datos no han sido almacenados. Vuelva a intertarlo mas tarde.";
		}
	}
	if($_POST['hst_hop']==2){
		$id = $_POST['hst_hid'];
		$where = " ID = ".$id;
		if(($dbf-> updateDB('TBL_HISTORIA',$data,$where,true)==true)){
			$mns .= "Los datos fueron actualizados exitosamente.";
			if ($_FILES["hst_img"]["error"] > 0){
				$mns .= "";
				}
			else{
				$x = explode("/",$_FILES['hst_img']['type']);
				$nm = "hst_".$id.".".$x[1];
				guardar_imagen($nm,$id);
				}
			}
		else{
			$mns .= "Los datos no han sido actualizados. Vuelva a intertarlo mas tarde.";
			}
		}
//mysqli_close($con);	

function guardar_imagen($name,$id){
	global $mns;
	if(isset($_FILES)){
		$file_tmp  = $_FILES['hst_img']['tmp_name'];
		$file_name = $_FILES['hst_img']['name'];
		//$directory_path = $_SERVER["DOCUMENT_ROOT"]."/public/producto/$file_name";
		$directory_path = "public/historia/";
		if(is_uploaded_file($file_tmp)) {
			if(is_dir($directory_path)){
				if(move_uploaded_file($file_tmp, $directory_path.$name)){
					echo '{"success": true}';
					$mns .= "La imagen fue almacenada satisfactoriamente";
					guardar_txt_img($name,$id);
					//unlink("tmp/$file_name");
					}
				else{
					$mns .= "La imagen no ha sido almacenada";
					echo '{"success": false}';
					}
			}
			else{
				echo "No such directory exists";
				}    
    	}
		else{
			echo '{success: false}';
			}
		}
	}
function nombre(){
	if($_FILES["hst_img"]["error"] > 0){
		return '';
		}
	else{
		$x = substr($_FILES['hst_img']['type'],-3);
		$n = chr(rand(65,90)).chr(rand(65,90)).date('Ymd').".".$x;
		return $n;
		}
	}
function name_imagen($idp){
	global $db;
	echo "<br>";
	echo $sql = "SELECT IMAGEN FROM PED_PRODUCTO WHERE ID_PRODUCTO = ".$idp;
	echo "<br>";
		$qry = $db->sqlQuery($sql);
		//$cnt = $db->sqlEnumRows($qry);
		$row = $db->sqlFetchArray($qry);
		//$id  = ($cnt>0)?$row['ID']:0;
		return $row['IMAGEN'];
	
	}	
function last_id(){
	global $db;
	$sql = "SELECT LAST_INSERT_ID() AS ID ";
	$qry = $db->sqlQuery($sql);
	$row = $db->sqlFetchArray($qry);
	return $row['ID'];
	}	
function guardar_txt_img($name,$id){
	global $db,$dbf;
	$data = Array(
		'IMAGEN'	=> $name
		);
	$where = " ID  = ".$id;
		$dbf-> updateDB('TBL_HISTORIA',$data,$where,true);
	}	
?>
<script type="text/javascript">
var mns = '<?php echo $mns; ?>';
console.log(mns);
parent.hst_mensaje(mns);
</script>	