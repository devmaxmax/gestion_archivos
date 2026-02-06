<?php 
include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=6 and $_SESSION["IdPerfilUser"]!=7 and $_SESSION["IdPerfilUser"]!=9 and $_SESSION["IdPerfilUser"]!=10 and $_SESSION["IdPerfilUser"]!=11 and $_SESSION["IdPerfilUser"]!=12 and $_SESSION["IdPerfilUser"]!=14 and $_SESSION["IdPerfilUser"]!=15){ header("Location:".$_SESSION["NivelArbol"]."Inicio.php");}


if (isset($_POST['CmdCopiar'])){//solo copia si en actual no existe
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	//busco original
	$query="SELECT * From hist_clientes where Id=".intval($_POST['TxtNumero']); $rs=mysql_query($query,$conn);
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
		$tel=$row['Telefono'];
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
		$idasig=$row['IdAsignado'];
		$emailf=mysql_real_escape_string($row['EMailFactura']);
		$fechahora=$row['EnvioFactura']; 
		$emailinf=$row['EMailInformes'];
		$fechahora2=$row['EnvioInforme']; 
	}mysql_free_result($rs);
	//verifico que no exista el cuit en base actual
	$query="SELECT Id FROM clientes Where Identificacion='$cuit'";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)==0){$existe=0;}else{$existe=1;}mysql_free_result($rs);	
	if($existe==0){//si no existe el cuit en base actual
		//inserto cliente copiado
		$nroId=GLO_generoID('clientes',$conn);
		$query="INSERT INTO clientes (Id,RazonSocial,Nacionalidad,CondicionIva,TipoIdentificacion,Identificacion,Observaciones,TipoPersona,Envio,Entrega,ParaEmpresa,IdActividad,NombreFantasia,Logo,Bloqueado,Motivo,Direccion,IdLocalidad,Provincia,CP,EMail,ObsEmail,EMailResultados,Telefono,LogoCertificado,Oreste,TipoCliente,FPago,ObsEval,ObsCE,Generico,SEMail,ObsCO,IdAsignado,EMailFactura,EnvioFactura,EMailInformes,EnvioInforme,Ajuste,SinPF,SinEval,RF) VALUES ($nroId,'$nombre','$nac','$cond','CUIT','$cuit','$obs','$tipop',$envio,$entrega,'$nombrepe',$idactiv,'$nombref','$logo',$bloq,'$motbloq','$dir',$idloc,'$pcia','$cp','$mail','$obsmail','$mailres','$tel',$logoc,$oreste,'$tipoc','$tipofp','$obsev','$obsce',$clgen,$semail,'$obsco',$idasig,'$emailf','$fechahora','$emailinf','$fechahora2',0,$spf,$sineval,0)";
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
				$query="SELECT Max(Id) as UltimoId FROM telefonos";			$rs3=mysql_query($query,$conn);$row3=mysql_fetch_array($rs3);
				if(mysql_num_rows($rs3)==0){$nroId3=1;}else{$nroId3=$row3['UltimoId']+1;}		mysql_free_result($rs3);
				//inserto
				$query="INSERT INTO telefonos (Id,IdEntidad,CodigoArea,NumeroTelefono,Observaciones,TipoEntidad) VALUES ($nroId3,$ident,'$coda','$nrotel','$obs','$tipoent')";
				$rs3=mysql_query($query,$conn);
			}mysql_free_result($rs);
			//grabar autorizados
			//busco original
			$query="SELECT * From hist_autorizados where IdEntidad=".intval($_POST['TxtNumero']); $rs=mysql_query($query,$conn);
			while($row=mysql_fetch_array($rs)){
				$ident=$nroId;			
				$nom=mysql_real_escape_string($row['Nombre']);
				$ap=mysql_real_escape_string($row['Apellido']);
				$dni=$row['DNI'];
				$der=$row['Derecho'];
				$tipoent=$row['TipoEntidad'];		
				//generoid
				$query="SELECT Max(Id) as UltimoId FROM autorizados";		$rs3=mysql_query($query,$conn);$row3=mysql_fetch_array($rs3);
				if(mysql_num_rows($rs3)==0){$nroId3=1;}else{$nroId3=$row3['UltimoId']+1;}		mysql_free_result($rs3);
				//inserto
				$query="INSERT INTO autorizados (Id,IdEntidad,Nombre,Apellido,DNI,Derecho,TipoEntidad) VALUES ($nroId3,$ident,'$nom','$ap','$dni','$der','$tipoent')";
				$rs3=mysql_query($query,$conn);	
			}mysql_free_result($rs);
			//cierro y vuelvo
			mysql_close($conn); 
			foreach($_POST as $key => $value){$_SESSION[$key] = "";}		
			header("Location:Modificar.php?id=".$idvolver."&Flag1=True");
		}else{// si no se copio bien el cliente
			//cierro y vuelvo
			mysql_close($conn); 
			foreach($_POST as $key => $value){$_SESSION[$key] = "";}
			GLO_feedback(2);		
			header("Location:ModificarH.php?id=".intval($_POST['TxtNumero'])."&Flag1=True");
		} 
	}else{//si ya existe el cliente	
		//cierro y vuelvo
		mysql_close($conn); 
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}		
		GLO_feedback(18);header("Location:ModificarH.php?id=".intval($_POST['TxtNumero'])."&Flag1=True");
	}
}





else //Click en combo localidad:muestra la provincia y el cp
{
$Provincia="";
$CP="";
$valor=intval($_POST['CbLocalidad']);
if ($valor != ""){
	$query="SELECT p.Nombre,l.CP  From provincias p, localidades l Where l.IdPcia=p.Id and l.Id= $valor";
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);	
	$row=mysql_fetch_array($rs);
	$Provincia=$row['Nombre'];	$CP=$row['CP'];	
	mysql_free_result($rs);	mysql_close($conn); 
}
//obtener datos del form anterior
foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
$_SESSION['TxtProvincia'] = $Provincia;$_SESSION['TxtCP'] = $CP;
header("Location:ModificarH.php?id=".intval($_POST['TxtNumero'])."&Flag1=False");

}

?>


