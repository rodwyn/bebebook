<?php
/** Include path **/
//set_include_path('./Classes/');

/** PHPExcel_IOFactory */
include 'Classes/PHPExcel/IOFactory.php';
$nams='PHPExcleReader';
$inputFileName = '/PT1.xlsx';  

//echo __FILE__;
eliminarDir(dirname(__FILE__).'/PT1.xlsx');



if ($_FILES['gral_file_exc']["error"] > 0){
	  echo "Error: " . $_FILES['gral_file_exc']['error'] . "<br>";
	$T=0;
  }

else {

$T = 1;
$f = $_POST['gral_fun'];
$muve=move_uploaded_file($_FILES['gral_file_exc']["tmp_name"], dirname(__FILE__).'/PT1.xlsx');



 }





function eliminarDir($carpeta){
			
			 foreach(glob($carpeta."/*") as $archivos_carpeta) {
			 echo $archivos_carpeta; 
			 if(is_dir($archivos_carpeta)) eliminarDir($archivos_carpeta); 
			 else unlink($archivos_carpeta); 
			 }
			  $do = rmdir($carpeta); 
			  if($do == true){
					return 2;
				}
				
		  }
?>
<script type="text/javascript">
var na = '<?php echo $T; ?>';
var fn = '<?php echo $f; ?>';
//console.log(na)
parent.gral_data_excel(na,fn);
</script>