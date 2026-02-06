<?php
include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=6 and $_SESSION["IdPerfilUser"]!=7 and $_SESSION["IdPerfilUser"]!=9 and $_SESSION["IdPerfilUser"]!=10 and $_SESSION["IdPerfilUser"]!=11 and $_SESSION["IdPerfilUser"]!=12 and $_SESSION["IdPerfilUser"]!=14 and $_SESSION["IdPerfilUser"]!=15){ header("Location:".$_SESSION["NivelArbol"]."Inicio.php");}



if (isset($_POST['CmdAceptar'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	include ("Includes/zValidaGrabar.php");	
	//graba?
	if($guardar=='si'){
		include ("Includes/zDatosGrabar.php");
		//update
		$query="UPDATE clientes set RazonSocial='".$nombre."' ,Nacionalidad='".$nac."' ,CondicionIva='".$cond."' ,Identificacion='".$cuit."' ,Observaciones='$obs' ,TipoPersona='".$tipop."' ,Envio=".$envio.",Entrega=".$entrega.",ParaEmpresa='".$nombrepe."',IdActividad=".$idactiv.",NombreFantasia='".$nombref."',Bloqueado=".$bloq.",Motivo='".$motbloq."',Direccion='".$dir."',IdLocalidad=".$idloc.",Provincia='".$pcia."',CP='".$cp."',EMail='".$mail."',ObsEMail='$obsmail',EMailResultados='$mailres',Telefono='$tel',LogoCertificado=$logoc,Oreste=$oreste,FPago='$tipofp' ,ObsEval='$obsev' ,ObsCE='$obsce',Generico=$clgen,SEMail=$semail,ObsCO='$obsco',IdAsignado=$asig,EMailFactura='$emailf',EMailInformes='$emailinf' $wajuste,SinPF=$spf,SinEval=$sineval,RF=$rf Where Id=".intval($_POST['TxtNumero']);$rs=mysql_query($query,$conn);
		if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 			
		//auditoria si era fpago ctdo(ccbloq) y lo saca
		if ($_POST['OptFPIni']=='C' and $_POST['OptFP']!='C' ){	InsertarAuditoria(3,13,intval($_POST['TxtNumero']),$conn); }
		//volver	
		mysql_close($conn); 		
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:Modificar.php?id=".intval($_POST['TxtNumero'])."&Flag1=True");
	}else{	
		mysql_close($conn); 		
		header("Location:Modificar.php?id=".intval($_POST['TxtNumero']));
	}
}




elseif (isset($_POST['CmdLinkRow1'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = "";}
	header("Location:ModificarTelefono.php?id=".intval($_POST['TxtId'])."&Flag1=True&identidad=".intval($_POST['TxtNumero']));
}

elseif (isset($_POST['CmdBorrarFilaT'])){
	$query="Delete From telefonos Where Id=".intval($_POST['TxtId']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
	mysql_close($conn); 
	header("Location:Modificar.php?id=".intval($_POST['TxtNumero'])."&Flag1=True");	
}

elseif (isset($_POST['CmdAddT'])){
	header("Location:AltaTelefono.php?Id=".intval($_POST['TxtNumero'])."&identidad=".intval($_POST['TxtNumero'])."&tipo=".$_POST['IdOptTipoC']);
}
//
elseif (isset($_POST['CmdLinkRow2'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = "";}
	header("Location:ModificarAutorizado.php?id=".intval($_POST['TxtId'])."&Flag1=True&identidad=".intval($_POST['TxtNumero']));
}

elseif (isset($_POST['CmdBorrarFilaA'])){
	$query="Delete From autorizados Where Id=".intval($_POST['TxtId']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
	mysql_close($conn); 
	header("Location:Modificar.php?id=".intval($_POST['TxtNumero'])."&Flag1=True");	
}

elseif (isset($_POST['CmdAddA'])){
	header("Location:AltaAutorizado.php?Id=".intval($_POST['TxtNumero'])."&identidad=".intval($_POST['TxtNumero'])."&tipo=".$_POST['IdOptTipoC']);
}


//

elseif (isset($_POST['CmdPagos'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = "";}
	header("Location:../PagosCuenta/PagosCliente.php?Id=".intval($_POST['TxtNumero']));
}

elseif (isset($_POST['CmdMasDatos'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = "";}
	header("Location:MasDatos.php?id=".intval($_POST['TxtNumero'])."&Flag1=True");
}

elseif (isset($_POST['CmdPrestacion'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = "";}
	header("Location:../Pacientes.php?idcli=".intval($_POST['TxtNumero']));
}

elseif (isset($_POST['CmdCopiar'])){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	//busco original
	$query="SELECT * From clientes where Id=".intval($_POST['TxtNumero']); $rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){
		$nombre=mysql_real_escape_string($row['RazonSocial']);
		$nac=mysql_real_escape_string($row['Nacionalidad']);
		$cond=$row['CondicionIva'];
		$cuit=$row['Identificacion'];
		$obs=mysql_real_escape_string($row['Observaciones']);
		$tipop=$row['TipoPersona'];
		$envio=$row['Envio'];
		$entrega=$row['Entrega'];
		$nombrepe=mysql_real_escape_string($row['ParaEmpresa']);
		$idactiv=$row['IdActividad'];
		$nombref=mysql_real_escape_string($row['NombreFantasia']);
		$logo=$row['Logo'];
		$bloq=$row['Bloqueado'];
		$motbloq=mysql_real_escape_string($row['Motivo']);
		$dir=mysql_real_escape_string($row['Direccion']);
		$idloc=$row['IdLocalidad'];
		$pcia=$row['Provincia'];
		$cp=$row['CP'];
		$mail=mysql_real_escape_string($row['EMail']);
		$obsmail=mysql_real_escape_string($row['ObsEMail']);
		$mailres=mysql_real_escape_string($row['EMailResultados']);
		$tel=mysql_real_escape_string($row['Telefono']);
		$logoc=$row['LogoCertificado'];
		$oreste=$row['Oreste'];		
		$tipoc=$row['TipoCliente'];
		$tipofp=$row['FPago'];
		$obsev=mysql_real_escape_string($row['ObsEval']);
		$obsce=mysql_real_escape_string($row['ObsCE']);
		$obsco=mysql_real_escape_string($row['ObsCO']);
		$clgen=$row['Generico'];
		$semail=$row['SEMail'];
		$spf=$row['SinPF'];
		$sineval=$row['SinEval'];
		$asig=$row['IdAsignado'];
		$emailf=$row['EMailFactura'];
		$fechahora=$row['EnvioFactura']; 
		$emailinf=$row['EMailInformes'];
		$fechahora2=$row['EnvioInforme']; 
		$rf=$row['RF']; //retira fisico
	}mysql_free_result($rs);
	//inserto cliente copiado
	$nroId=GLO_generoID('clientes',$conn);
	$query="INSERT INTO clientes (Id,RazonSocial,Nacionalidad,CondicionIva,TipoIdentificacion,Identificacion,Observaciones,TipoPersona,Envio,Entrega,ParaEmpresa,IdActividad,NombreFantasia,Logo,Bloqueado,Motivo,Direccion,IdLocalidad,Provincia,CP,EMail,ObsEmail,EMailResultados,Telefono,LogoCertificado,Oreste,TipoCliente,FPago,ObsEval,ObsCE,Generico,SEMail,ObsCO,IdAsignado,EMailFactura,EnvioFactura,EMailInformes,EnvioInforme,Ajuste,SinPF,SinEval,RF) VALUES ($nroId,'$nombre','$nac','$cond','CUIT','$cuit','$obs','$tipop',$envio,$entrega,'$nombrepe',$idactiv,'$nombref','$logo',$bloq,'$motbloq','$dir',$idloc,'$pcia','$cp','$mail','$obsmail','$mailres','$tel',$logoc,$oreste,'$tipoc','$tipofp','$obsev','$obsce',$clgen,$semail,'$obsco',$asig,'$emailf','$fechahora','$emailinf','$fechahora2',0,$spf,$sineval,$rf)";
	$rs=mysql_query($query,$conn);
	if ($rs){
		GLO_feedback(1);$idvolver=$nroId;
		//grabar telefonos
		//busco original
		$query="SELECT * From telefonos where IdEntidad=".intval($_POST['TxtNumero']); $rs=mysql_query($query,$conn);
		while($row=mysql_fetch_array($rs)){
			$ident=$nroId;
			$coda=$row['CodigoArea'];
			$nrotel=$row['NumeroTelefono'];
			$obs=mysql_real_escape_string($row['Observaciones']);
			$tipoent=$row['TipoEntidad'];		
			//generoid
			$query="SELECT Max(Id) as UltimoId FROM telefonos";	$rs3=mysql_query($query,$conn);$row3=mysql_fetch_array($rs3);
			if(mysql_num_rows($rs3)==0){$nroId3=1;}else{$nroId3=$row3['UltimoId']+1;}	mysql_free_result($rs3);
			//inserto
			$query="INSERT INTO telefonos (Id,IdEntidad,CodigoArea,NumeroTelefono,Observaciones,TipoEntidad) VALUES ($nroId3,$ident,'$coda','$nrotel','$obs','$tipoent')";
			$rs3=mysql_query($query,$conn);
		}mysql_free_result($rs);
		//grabar autorizados
		//busco original
		$query="SELECT * From autorizados where IdEntidad=".intval($_POST['TxtNumero']); $rs=mysql_query($query,$conn);
		while($row=mysql_fetch_array($rs)){
			$ident=$nroId;			
			$nom=mysql_real_escape_string($row['Nombre']);
			$ap=mysql_real_escape_string($row['Apellido']);
			$dni=$row['DNI'];
			$der=$row['Derecho'];
			$tipoent=$row['TipoEntidad'];		
			//generoid
			$query="SELECT Max(Id) as UltimoId FROM autorizados";	$rs3=mysql_query($query,$conn);$row3=mysql_fetch_array($rs3);
			if(mysql_num_rows($rs3)==0){$nroId3=1;}else{$nroId3=$row3['UltimoId']+1;}	mysql_free_result($rs3);
			//inserto
			$query="INSERT INTO autorizados (Id,IdEntidad,Nombre,Apellido,DNI,Derecho,TipoEntidad) VALUES ($nroId3,$ident,'$nom','$ap','$dni','$der','$tipoent')";
			$rs3=mysql_query($query,$conn);	
		}mysql_free_result($rs);
	}else{GLO_feedback(2);$idvolver=intval($_POST['TxtNumero']); } 
	mysql_close($conn); 
	//limpiar datos del form anterior	
	foreach($_POST as $key => $value){$_SESSION[$key] = "";}		
	header("Location:Modificar.php?id=".$idvolver."&Flag1=True");
}













elseif (isset($_POST['CmdAddA'])){
	header("Location:AltaAutorizado.php?Id=".intval($_POST['TxtNumero'])."&identidad=".intval($_POST['TxtNumero'])."&tipo=".$_POST['OptTipoC']);
}






else{
include("../IncludesNG/ElseComboLoc.php");
header("Location:Modificar.php?id=".intval($_POST['TxtNumero'])."&Flag1=False");

}

?>


