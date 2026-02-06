<?php include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=10 and $_SESSION["IdPerfilUser"]!=14 and $_SESSION["IdPerfilUser"]!=15){ header("Location:".$_SESSION["NivelArbol"]."Inicio.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if ($_GET['Flag1']=="True"){
	$query="SELECT * From clientes where Id<>0 and Id=".intval($_GET['id'])." LIMIT 1"; 
	$rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){
		$_SESSION['TxtNumero']= str_pad($row['Id'], 6, "0", STR_PAD_LEFT);
	}
	mysql_free_result($rs);
} 

//get (seguridad)
GLO_ValidaSESSION($_SESSION['TxtNumero'],0,$conn);

GLOF_Init('','BannerConMenuHV','zMasDatos',1,'',0,0,1); 
GLO_tituloypath(850,850,'../Clientes.php','MAS DATOS DEL CLIENTE','linksalir');
?>


<?php include ("../Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="Formulario" method="post" action="zMasDatos.php" enctype="multipart/form-data">
<table width="850" border="0" cellspacing="0" class="Tabla TMT">
<tr><td width="30" height="3"></td><td width="120"></td><td width="700"></td></tr>
<tr><td></td><td height="18" align="right">Cliente:</td><td> &nbsp; <input name="TxtNumero" type="text" readonly="true" class="TextBoxRO" value="<?php echo $_SESSION['TxtNumero'];?>" style="text-align:right;width:50px">&nbsp;<label style="color:#0079b1; font-weight:bold"><?php echo $_SESSION['TxtNombre']; ?></label></td></tr>
</table>

<!-- LOGO DE EMPRESA -->
<table width="850" border="0" cellspacing="0" class="Tabla TMT">
<tr><td width="200" height="3"></td><td width="650"></td></tr>
<tr><td height="18" align="left" colspan="2">&nbsp;<strong style="color:#0079b1;">LOGO DE EMPRESA:</strong></td></tr>
<tr></td><td> &nbsp; <input name="Logo" id="Logo" type="file" class="TextBox" style="width:400px"></td></tr>
</table>

<table border="0" cellpadding="0" cellspacing="0"><tr><td height="3"></td></tr></table>

<!-- FIRMAS DE REPRESENTANTE -->
<table width="850" border="0" cellspacing="0" class="Tabla TMT">
<tr><td width="200" height="3"></td><td width="650"></td></tr>
<tr><td height="18" align="left" colspan="2">&nbsp;<strong style="color:#0079b1;">FIRMAS DE REPRESENTANTE:</strong></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Representante 1:</td><td> &nbsp; <input name="FirmaRepresentante" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Representante 2:</td><td> &nbsp; <input name="FirmaRepresentante2" type="file" class="TextBox" style="width:400px"></td></tr>
</table>

<table border="0" cellpadding="0" cellspacing="0"><tr><td height="3"></td></tr></table>

<!-- FIRMAS DE MÉDICO -->
<table width="850" border="0" cellspacing="0" class="Tabla TMT">
<tr><td width="200" height="3"></td><td width="650"></td></tr>
<tr><td height="18" align="left" colspan="2">&nbsp;<strong style="color:#0079b1;">FIRMAS DE MÉDICO:</strong></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Médico 1:</td><td> &nbsp; <input name="FileFirmaMed1" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Médico 2:</td><td> &nbsp; <input name="FileFirmaMed2" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Médico 3:</td><td> &nbsp; <input name="FileFirmaMed3" type="file" class="TextBox" style="width:400px"></td></tr>
</table>

<table border="0" cellpadding="0" cellspacing="0"><tr><td height="3"></td></tr></table>

<!-- FIRMAS DE ASIGNADO 1 -->
<table width="850" border="0" cellspacing="0" class="Tabla TMT">
<tr><td width="200" height="3"></td><td width="650"></td></tr>
<tr><td height="18" align="left" colspan="2">&nbsp;<strong style="color:#0079b1;">FIRMAS DE ASIGNADO 1:</strong></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 1-1:</td><td> &nbsp; <input name="FileFirmaAsig1_1" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 1-2:</td><td> &nbsp; <input name="FileFirmaAsig1_2" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 1-3:</td><td> &nbsp; <input name="FileFirmaAsig1_3" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 1-4:</td><td> &nbsp; <input name="FileFirmaAsig1_4" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 1-5:</td><td> &nbsp; <input name="FileFirmaAsig1_5" type="file" class="TextBox" style="width:400px"></td></tr>
</table>

<table border="0" cellpadding="0" cellspacing="0"><tr><td height="3"></td></tr></table>

<!-- FIRMAS DE ASIGNADO 2 -->
<table width="850" border="0" cellspacing="0" class="Tabla TMT">
<tr><td width="200" height="3"></td><td width="650"></td></tr>
<tr><td height="18" align="left" colspan="2">&nbsp;<strong style="color:#0079b1;">FIRMAS DE ASIGNADO 2:</strong></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 2-1:</td><td> &nbsp; <input name="FileFirmaAsig2_1" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 2-2:</td><td> &nbsp; <input name="FileFirmaAsig2_2" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 2-3:</td><td> &nbsp; <input name="FileFirmaAsig2_3" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 2-4:</td><td> &nbsp; <input name="FileFirmaAsig2_4" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Firma Asignado 2-5:</td><td> &nbsp; <input name="FileFirmaAsig2_5" type="file" class="TextBox" style="width:400px"></td></tr>
</table>

<table border="0" cellpadding="0" cellspacing="0"><tr><td height="3"></td></tr></table>

<!-- IMÁGENES ADICIONALES -->
<table width="850" border="0" cellspacing="0" class="Tabla TMT">
<tr><td width="200" height="3"></td><td width="650"></td></tr>
<tr><td height="18" align="left" colspan="2">&nbsp;<strong style="color:#0079b1;">IMÁGENES ADICIONALES:</strong></td></tr>
<tr><td height="18" align="right">&nbsp;Imagen Adicional 1:</td><td> &nbsp; <input name="FileImagen1" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Imagen Adicional 2:</td><td> &nbsp; <input name="FileImagen2" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Imagen Adicional 3:</td><td> &nbsp; <input name="FileImagen3" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Imagen Adicional 4:</td><td> &nbsp; <input name="FileImagen4" type="file" class="TextBox" style="width:400px"></td></tr>
<tr><td height="18" align="right">&nbsp;Imagen Adicional 5:</td><td> &nbsp; <input name="FileImagen5" type="file" class="TextBox" style="width:400px"></td></tr>
</table>

<?php 
GLO_Hidden('TxtId',0);
GLO_botonesform(850,0,2); 
GLO_mensajeerror(); 
GLO_cierratablaform();
?>
</form>
<?php 

// Mostrar imagenes desde BD agrupadas por categoria
$queryImagenes = "SELECT p.Id, p.nombreImagen, p.fechaHora, c.Nombre as categoriaNombre, c.Descripcion 
                  FROM parametros_img p 
                  INNER JOIN categoria_parametros_img c ON p.categoria_id = c.Id 
                  WHERE p.cliente_id = ".intval($_SESSION['TxtNumero'])."
                  ORDER BY c.Id, p.fechaHora DESC";
$rsImagenes = mysql_query($queryImagenes, $conn);

$imagenesGrouped = array();
while ($rowImg = mysql_fetch_array($rsImagenes)) {
	$catNombre = $rowImg['categoriaNombre'];
	if (!isset($imagenesGrouped[$catNombre])) {
		$imagenesGrouped[$catNombre] = array();
	}
	$imagenesGrouped[$catNombre][] = array(
		'id' => $rowImg['Id'],
		'nombre' => $rowImg['nombreImagen'],
		'fecha' => $rowImg['fechaHora'],
		'descripcion' => $rowImg['Descripcion']
	);
}

if (count($imagenesGrouped) > 0) {
	echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td height="10"></td></tr></table>';
	echo '<table width="850" border="0" cellspacing="0" class="Tabla TMT">';
	echo '<tr><td height="18" align="left" colspan="4">&nbsp;<strong style="color:#0079b1;">IMÁGENES CARGADAS:</strong></td></tr>';
	echo '<tr><td height="3" colspan="4"></td></tr>';
	
	$categoriaLabels = array(
		'Logo' => 'Logo de Empresa',
		'FirmaRepresentante' => 'Firmas de Representante',
		'FirmaMedico' => 'Firmas de Médico',
		'FirmaAsignado1' => 'Firmas de Asignado 1',
		'FirmaAsignado2' => 'Firmas de Asignado 2',
		'Imagenes' => 'Imágenes Adicionales'
	);
	
	$uploadDir = "../Archivos/ParametrosImg/".intval($_SESSION['TxtNumero'])."/";
	
	foreach ($imagenesGrouped as $catNombre => $imagenes) {
		$labelCategoria = isset($categoriaLabels[$catNombre]) ? $categoriaLabels[$catNombre] : $catNombre;
		echo '<tr><td height="18" align="left" colspan="4">&nbsp;<strong>'.$labelCategoria.':</strong></td></tr>';
		
		foreach ($imagenes as $img) {
			$filePath = $uploadDir . $img['nombre'];
			$fileUrl = str_replace('../', '', $filePath);
			
			echo '<tr>';
			echo '<td width="30"></td>';
			echo '<td width="150" align="center" style="padding:5px;">';
			echo '<a href="'.$fileUrl.'" target="_blank">';
			echo '<img src="'.$fileUrl.'" style="max-width:120px; max-height:80px; border:1px solid #ccc; padding:2px;" />';
			echo '</a>';
			echo '</td>';
			echo '<td width="550" align="left">&nbsp;'.$img['nombre'].'<br>&nbsp;<small style="color:#666;">'.date('d/m/Y H:i', strtotime($img['fecha'])).'</small></td>';
			echo '<td width="120" align="right">';
			echo '<button type="button" class="boton02" style="width:70px" onclick="if(confirm(\'¿Eliminar esta imagen?\')) { window.location.href=\'zEliminarImagen.php?id='.$img['id'].'&cliente_id='.$_SESSION['TxtNumero'].'\'; }">Eliminar</button>';
			echo '&nbsp;</td>';
			echo '</tr>';
		}
	}
	
	echo '</table>';
}

mysql_close($conn);

include ("../Codigo/FooterConUsuario.php");
?>
