<?php
include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";

if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=10 and $_SESSION["IdPerfilUser"]!=14 and $_SESSION["IdPerfilUser"]!=15){ header("Location:".$_SESSION["NivelArbol"]."Inicio.php");}

if (isset($_POST['CmdAceptar'])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	
	$clienteId = intval($_POST['TxtNumero']);
	if ($clienteId == 0) {
		$clienteId = intval($_SESSION['TxtNumero']);
	}
	
	$uploadDir = "/var/www/html/Archivos/ParametrosImg/".$clienteId."/";
	
	if (!file_exists($uploadDir)) {
		mkdir($uploadDir, 0777, true);
		chmod($uploadDir, 0777);

		@chown($uploadDir, 'apache');
        @chgrp($uploadDir, 'apache');
	}
	
	// Mapeo simple: campo => categoria
	$mapeoCategoria = array(
		'Logo' => 'Logo',
		'FirmaRepresentante' => 'FirmaRepresentante',
		'FirmaRepresentante2' => 'FirmaRepresentante',
		'FileFirmaMed1' => 'FirmaMedico',
		'FileFirmaMed2' => 'FirmaMedico',
		'FileFirmaMed3' => 'FirmaMedico',
		'FileFirmaAsig1_1' => 'FirmaAsignado1',
		'FileFirmaAsig1_2' => 'FirmaAsignado1',
		'FileFirmaAsig1_3' => 'FirmaAsignado1',
		'FileFirmaAsig1_4' => 'FirmaAsignado1',
		'FileFirmaAsig2_1' => 'FirmaAsignado2',
		'FileFirmaAsig2_2' => 'FirmaAsignado2',
		'FileFirmaAsig2_3' => 'FirmaAsignado2',
		'FileFirmaAsig2_4' => 'FirmaAsignado2',
		'FileFirmaAsig2_5' => 'FirmaAsignado2',
		'FileImagen1' => 'Imagenes',
		'FileImagen2' => 'Imagenes',
		'FileImagen3' => 'Imagenes',
		'FileImagen4' => 'Imagenes',
		'FileImagen5' => 'Imagenes'
	);
	
	$uploadedCount = 0;
	$errors = array();

	echo "<pre>";
	echo "POST size: " . $_SERVER['CONTENT_LENGTH'] . " bytes\n";
	echo "Max Post size: " . ini_get('post_max_size') . "\n";
	echo "Max Upload size: " . ini_get('upload_max_filesize') . "\n";
	echo "FILES array: "; print_r($_FILES);
	echo "Errores detectados: "; print_r(error_get_last());
	echo "</pre>";
	die();

	// echo "<pre>";
	// print_r($_FILES); // Verifica si 'error' es 0 o si hay un código de error
	// echo "Ruta destino: " . $destination;
	// echo " Es escribible: " . (is_writable($uploadDir) ? 'SI' : 'NO');
	// echo "</pre>";
	// die();
	
	foreach ($mapeoCategoria as $fieldName => $nombreCategoria) {
		if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == 0) {
			$fileName = $_FILES[$fieldName]['name'];
			$fileSize = $_FILES[$fieldName]['size'];
			$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
			
			$allowedExts = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
			if (in_array($fileExt, $allowedExts)) {
				if ($fileSize <= 5242880) {
					$newFileName = strtolower($nombreCategoria) . '_' . time() . '_' . rand(1000,9999) . '.' . $fileExt;
					$destination = $uploadDir . $newFileName;
					
					if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $destination)) {
						chmod($destination, 0777);
						
						//Buscamos el ID de la categoria
						$queryCat = "SELECT Id FROM categoria_parametros_img WHERE Nombre = '$nombreCategoria'";
						$rsCat = mysql_query($queryCat, $conn);
						if ($rowCat = mysql_fetch_array($rsCat)) {
							$categoriaId = $rowCat['Id'];
							
							//Guardamos
							$queryInsert = "INSERT INTO parametros_img (cliente_id, categoria_id, nombreImagen) VALUES ($clienteId, $categoriaId, '$newFileName')";
							mysql_query($queryInsert, $conn);
						}
						
						$uploadedCount++;
					} else {
						$errors[] = "Error al subir: " . $fieldName;
					}
				} else {
					$errors[] = $fieldName . " excede 5MB";
				}
			} else {
				$errors[] = $fieldName . " extension no permitida";
			}
		}
	}
	
	if ($uploadedCount > 0) {
		GLO_feedback(1);
		InsertarAuditoria(3, 50, $clienteId, $conn);
	}
	
	if (count($errors) > 0) {
		$_SESSION['GLO_MensajeError'] = implode('<br>', $errors);
	}
	
	mysql_close($conn);
	header("Location:MasDatos.php?id=".$clienteId."&Flag1=True");
}
else{
	header("Location:MasDatos.php?id=".intval($_POST['TxtNumero'])."&Flag1=True");
}
?>
