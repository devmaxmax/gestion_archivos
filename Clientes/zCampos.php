<?php include("../Codigo/Seguridad.php") ; 
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=6 and $_SESSION["IdPerfilUser"]!=7 and $_SESSION["IdPerfilUser"]!=9 and $_SESSION["IdPerfilUser"]!=10 and $_SESSION["IdPerfilUser"]!=11 and $_SESSION["IdPerfilUser"]!=12 and $_SESSION["IdPerfilUser"]!=14 and $_SESSION["IdPerfilUser"]!=15){ header("Location:".$_SESSION["NivelArbol"]."Inicio.php");}

GLO_mensajeerrorE(); 
?>



<table width="850" border="0"  cellspacing="0" class="Tabla" >
<tr><td width="30" height="3"></td><td width="70"></td><td width="210"></td> <td width="170"></td><td width="370"></td></tr>
<tr><td><?php if(intval($_SESSION['TxtNumero'])!=0){GLO_CmdMailAdmin(2,intval($_SESSION['TxtNumero']),0);}?></td><td height="18"  align="right">Numero:</td><td> &nbsp; <input  name="TxtNumero" type="text"  readonly="true"  class="TextBoxRO"   value="<?php echo $_SESSION['TxtNumero'];?>" style="text-align:right;width:50px">&nbsp;<label style="color:#0079b1; font-weight:bold"><?php if ($_SESSION['OptTipoC'] =='E'){ echo ' EMPRESA';}	 if ($_SESSION['OptTipoC'] =='A'){ echo ' ART';} ?></label> </td><td><?php if(intval($_SESSION['TxtNumero'])!=0){echo '<input name="TxtLeyenda"  style="border: none;background:transparent;color:#f44336;width:100px; font-weight:bold"  readonly="true" type="text" class="TextBox"    value="'; echo $_SESSION['TxtLeyenda']; echo '">';}else{echo '<input name="OptTipoC"  type="radio"  class="radiob"    value="E"'; if ($_SESSION['OptTipoC'] =='E'){ echo 'checked';} echo' >Empresa   <input name="OptTipoC"  type="radio"  class="radiob"   value="A"'; if ($_SESSION['OptTipoC'] =='A') {echo 'checked';} echo ' >ART &nbsp;&nbsp;<label class="MuestraError"> * </label>';}?>
</td><td  align="right"><input  name="TxtGrabaCUIT"  type="hidden"  value="<?php echo $_SESSION['TxtGrabaCUIT']; ?>"><input  name="TxtId"  type="hidden"  value="<?php echo $_SESSION['TxtId']; ?>"><input  name="OptFPIni"  type="hidden"  value="<?php echo $_SESSION['OptFPIni']; ?>"><input  name="IdOptTipoC"  type="hidden"  value="<?php echo $_SESSION['IdOptTipoC']; ?>"><?php if(intval($_SESSION['TxtNumero'])!=0){ if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2 or $_SESSION["IdPerfilUser"]==10 or $_SESSION["IdPerfilUser"]==14 or $_SESSION["IdPerfilUser"]==15){echo '<button name="CmdCopiar" type="submit" class="boton02" style="width:80px"  onClick="return confirm('."'Desea Copiar el Cliente?'".');document.Formulario.target='."'_self'".'"> Copiar </button>&nbsp;';} echo '<button name="CmdMasDatos" class="boton02" type="submit" style="width:80px" onClick="document.Formulario.target='."'_self'".'"> Mas Datos </button>&nbsp;'; echo '<button name="CmdPrestacion" class="boton02" type="submit" style="width:80px" onClick="document.Formulario.target='."'_self'".'"> Prestacion </button>&nbsp;<button name="CmdPagos" type="submit" class="boton02" style="width:80px" onClick="document.Formulario.target='."'_blank'".'">Ex.Cuenta</button>&nbsp;';}?></td></tr>
</table> 



<table width="850" border="0"  cellspacing="0" class="Tabla TMT" >
<tr><td width="100" height="3"  ></td><td width="200"></td> <td width="180"></td><td width="185" ></td><td width="185"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Razon Social:</td><td  colspan="2"> &nbsp;  <input name="TxtNombre" type="text"  class="TextBox" style="width:310px" maxlength="100"  value="<?php echo $_SESSION['TxtNombre']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraError"> * </label></td><td   colspan="2"> &nbsp;<input name="ChkEntrega"  tabindex="60" type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkEntrega'] =='1') echo 'checked'; ?>  onclick="if (this.checked==true){document.Formulario.OptTipoE1[0].disabled=false;document.Formulario.OptTipoE1[1].disabled=false;document.Formulario.ChkPagoDest.disabled=false;document.Formulario.OptTipoE1[0].checked=true;}else{document.Formulario.OptTipoE1[0].disabled=true;document.Formulario.OptTipoE1[1].disabled=true;document.Formulario.ChkPagoDest.disabled=true;document.Formulario.OptTipoE1[0].checked=false;document.Formulario.OptTipoE1[1].checked=false;document.Formulario.ChkPagoDest.checked=false;}">
Entrega a Domicilio</td></tr>
<tr> <td height="18"  align="right"  >&nbsp;Condicion - CUIT:</td><td  colspan="2"> &nbsp;
<select name="CbCondicion" style="width:210px" class="campos" id="CbCondicion" onkeydown="enterxtab(event)">
<?php ComboCondicion(); ?></select>&nbsp; <input name="TxtCUIT" id="TxtCUIT" type="text"  class="TextBox"  maxlength="13"  style="width:93px"  value="<?php echo $_SESSION['TxtCUIT']; ?>"  onKeyDown="enterxtab(event)"><label class="MuestraError"> * </label></td><td   colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="OptTipoE1"  type="radio"  class="radiob"  value="M"<?php if ($_SESSION['OptTipoE1'] =='M') echo 'checked'; if ($_SESSION['ChkEntrega']==0)echo 'disabled';?> >Mensajeria   <input name="OptTipoE1"  type="radio"  class="radiob"   value="C"<?php if ($_SESSION['OptTipoE1'] =='C') echo 'checked';if ($_SESSION['ChkEntrega']==0)echo 'disabled'; ?> >Correo </td></tr>
<tr><td height="18"  align="right"  >&nbsp;Nacionalidad:</td><td  colspan="2" > &nbsp; <input name="TxtNacionalidad" type="text"  class="TextBox" style="width:310px" maxlength="30"  value="<?php echo $_SESSION['TxtNacionalidad']; ?>" onKeyDown="enterxtab(event)"></td><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="ChkPagoDest"  tabindex="61" type="checkbox"  class="check" value="1" <?php if ($_SESSION['ChkPagoDest'] =='1') echo 'checked'; if ($_SESSION['ChkEntrega']==0)echo 'disabled';?>>Pago en Destino </td></tr>
<tr><td height="18"  align="right"  >&nbsp;Para Empresa:</td><td  colspan="2"> &nbsp; <input name="TxtParaEmpresa" type="text"  class="TextBox" style="width:310px" maxlength="100"  value="<?php echo $_SESSION['TxtParaEmpresa']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td><td  colspan="2"></td></tr>
<tr><td height="18"  align="right"  >&nbsp;Alias:</td><td  colspan="2"> &nbsp; <input name="TxtNombreF" type="text"  class="TextBox" style="width:310px" maxlength="100"  value="<?php echo $_SESSION['TxtNombreF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td><td> &nbsp;<input name="ChkLogo"  tabindex="61" type="checkbox" class="check" value="1" <?php if ($_SESSION['ChkLogo'] =='1') echo 'checked'; ?>> Logo Certificado Aptitud</td><td> &nbsp;<input name="ChkMail"  type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkMail'] =='1') echo 'checked'; ?>>
Sin Envio de Mails</td></tr>
<tr> <td height="18"  align="right"  >&nbsp;Actividad:</td><td  colspan="2"> &nbsp; <select name="CbActividad" style="width:310px" class="campos" id="CbActividad"  ><option value=""></option> <?php ComboTablaRFX("actividades","CbActividad","Nombre","","",$conn); ?> </select></td><td > &nbsp;<input name="ChkOreste"  tabindex="62" type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkOreste'] =='1') echo 'checked'; ?>>
Certificado Oreste</td><td> &nbsp;<input name="ChkSPF"  type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkSPF'] =='1') echo 'checked'; ?>> Facturacion sin Paquetes</td></tr>
<tr> <td height="18"  align="right"  >Asignado:</td><td  colspan="2"> &nbsp; <select name="CbAsignado" style="width:310px" class="campos" id="CbAsignado"  ><option value=""></option> <?php ComboPersonalAsignado("CbAsignado",$conn); ?> </select></td><td> &nbsp;<input name="ChkGen"  type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkGen'] =='1') echo 'checked'; ?>> Cliente Generico</td><td> &nbsp;<input name="ChkSinEval"  type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkSinEval'] =='1') echo 'checked'; ?>> Sin Evaluacion</td></tr>

<tr> <td height="18"  align="right"  >Tipo Persona:</td><td  > &nbsp;<input name="OptTipoP"  type="radio"  class="radiob"    value="F"<?php if ($_SESSION['OptTipoP'] =='F') echo 'checked'; ?> >Fisica   <input name="OptTipoP"  type="radio"  class="radiob"   value="J"<?php if ($_SESSION['OptTipoP'] =='J') echo 'checked'; ?> >Juridica </td><td>Descuento:&nbsp;<input name="TxtAjuste"  type="text"  <?php if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2){echo 'class="TextBox"';}else{ echo 'readonly="true" class="TextBoxRO"';} ?>  style="width:56px;text-align:right"   maxlength="6" value="<?php echo $_SESSION['TxtAjuste']; ?>" onChange="this.value=validarNumero(this.value);">&nbsp;</td>
<td> &nbsp;<input name="ChkRF"  type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkRF'] =='1') echo 'checked'; ?>> Retira Fisico</td><td></td>	</tr>

<tr> <td height="18"  align="right"  >Forma de Pago:</td><td   colspan="2"> &nbsp;<input name="OptFP"  type="radio"  class="radiob"    value="A"<?php if ($_SESSION['OptFP'] =='A') echo 'checked'; ?> >CC        &nbsp; <input name="OptFP"  type="radio"  class="radiob"   value="B"<?php if ($_SESSION['OptFP'] =='B') echo 'checked'; ?> >Ctdo      &nbsp; <input name="OptFP"  type="radio"  class="radiob"   value="C"<?php if ($_SESSION['OptFP'] =='C') echo 'checked'; ?> >Ctdo(CC Bloq)</td>	<td  colspan="2"></td></tr>
</table> 




<!-- direccion -->
<table width="850" border="0"   cellspacing="0" class="Tabla TMT" >
<tr><td width="100" height="3"  ></td> <td width="325"></td><td width="100" height="3"  ></td> <td width="325"></td></tr>  
<tr> <td height="18"  align="right"  >&nbsp;Direccion:</td><td  colspan="3"> &nbsp; <input name="TxtDireccion" type="text"  class="TextBox" style="width:720px" maxlength="200"  value="<?php echo $_SESSION['TxtDireccion']; ?>"></td></tr>

<tr> <td height="18"  align="right"  >Localidad:</td><td  > &nbsp; <select name="CbLocalidad" style="width:310px" class="campos" id="CbLocalidad" onChange="this.form.submit()" onKeyDown="if (event.keyCode==13){document.Formulario.TxtTelefono.focus()}"><option value=""></option> <?php  ComboTablaRFX("localidades","CbLocalidad","Nombre","","",$conn);?> </select></td><td  align="right">Provincia:</td><td>&nbsp; <input name="TxtProvincia" type="text"  class="TextBoxRO" style="width:190px"  readonly="true" value="<?php echo $_SESSION['TxtProvincia']; ?>" >&nbsp;<input name="TxtCP" type="text"  class="TextBoxRO" style="width:100px"   readonly="true" value="<?php echo $_SESSION['TxtCP']; ?>">  </td></tr>
</table>  


<table width="850" border="0"   cellspacing="0" class="Tabla TMT" >
<tr><td width="100" height="3"  ></td> <td width="325"></td><td width="100" height="3"  ></td> <td width="325"></td></tr>  
<tr> <td height="18"  align="right"  >Telefono MED_EPAP:</td><td  > &nbsp; <input name="TxtTelefono" type="text"  class="TextBox" style="width:310px" maxlength="100"  value="<?php echo $_SESSION['TxtTelefono']; ?>"></td><td  align="right">eMail MED Epap:</td><td>&nbsp; <input name="TxtEMail" type="text"  class="TextBox" style="width:295px" maxlength="50"  value="<?php echo $_SESSION['TxtEMail']; ?>"> </td></tr>
<tr> <td height="18" align="right">Medico y Mat. EPAP-B9:</td><td colspan="3"> &nbsp; <input name="TxtObsEMail" type="text"  class="TextBox" style="width:720px" maxlength="150"  value="<?php echo $_SESSION['TxtObsEMail']; ?>"></td></tr> 
<!--
<tr> <td height="18" align="right">Apellido y Nombre TITULAR -PECOM:</td><td colspan="3"> &nbsp; <input name="TxtObsEMail" type="text"  class="TextBox" style="width:720px" maxlength="150"  value="<?php echo $_SESSION['TxtObsEMail']; ?>"></td></tr> 
<tr> <td height="18" align="right">Correo Electr EMPRE-PECOM:</td><td colspan="3"> &nbsp; <input name="TxtObsEMail" type="text"  class="TextBox" style="width:720px" maxlength="150"  value="<?php echo $_SESSION['TxtObsEMail']; ?>"></td></tr> 
<tr> <td height="18" align="right">TELEFONO TITULAR -PECOM:</td><td colspan="3"> &nbsp; <input name="TxtObsEMail" type="text"  class="TextBox" style="width:720px" maxlength="150"  value="<?php echo $_SESSION['TxtObsEMail']; ?>"></td></tr> 
-->

</table> 



<table width="850" border="0"   cellspacing="0" class="Tabla TMT" >
<tr><td width="100" height="3"  ></td> <td width="325"></td><td width="100"></td> <td width="325"></td></tr>  
<tr> <td height="18" align="right">EMail Masivos:</td><td colspan="3"> &nbsp; <input name="TxtEMailInformes" type="text"  class="TextBox" style="width:720px" maxlength="200" title="Separar correos con comas" value="<?php echo $_SESSION['TxtEMailInformes']; ?>"></td></tr> 
<tr> <td height="18" align="right">EMail Informes:</td><td colspan="3"> &nbsp; <input name="TxtEMailRes" type="text"  class="TextBox" style="width:720px" maxlength="255" title="Separar correos con comas"  value="<?php echo $_SESSION['TxtEMailRes']; ?>" /></td></tr> 
<tr> <td height="18" align="right">EMail Factura:</td><td colspan="3"> &nbsp; <input name="TxtEMailFactura" type="text"  class="TextBox" style="width:720px" maxlength="200" title="Separar correos con comas" value="<?php echo $_SESSION['TxtEMailFactura']; ?>"></td></tr> 
<tr> <td height="18" align="right">Envio Factura:</td><td>&nbsp; <input  name="TxtEnvioFactura" type="text"  readonly="true"  class="TextBoxRO"   value="<?php echo $_SESSION['TxtEnvioFactura'];?>" style="width:120px"> <label style="color:#666666;">(Ultimo enviado)</label></td><td  align="right">Envio Asistencia:</td><td>&nbsp; <input  name="TxtEnvioInforme" type="text"  readonly="true"  class="TextBoxRO"   value="<?php echo $_SESSION['TxtEnvioInforme'];?>" style="width:120px"> <label style="color:#666666;">(Ultimo enviado)</label></td></tr>
</table> 

<!-- bloq -->
<table width="850" border="0"   cellspacing="0" class="Tabla TMT" >
<tr><td width="100" height="3"  ></td> <td width="750"></td> </tr>
<tr><td height="18"  align="right"  >Bloqueado:</td><td  > &nbsp;<input name="ChkBloq" type="checkbox"  class="check"  value="1" <?php if ($_SESSION['ChkBloq'] =='1') echo 'checked'; ?>> <input name="TxtObsBloq" type="text"  class="TextBox" style="width:700px" maxlength="200"  value="<?php echo $_SESSION['TxtObsBloq']; ?>"></td></tr>
</table> 

<!-- obs -->
<table width="850" border="0"  cellspacing="0" class="Tabla TMT" >
<tr><td width="100" height="3"  ></td> <td width="750"></td> </tr>
<tr><td height="18"  align="right"  valign="top" >&nbsp;Recepcion:</td><td  > &nbsp; <textarea name="TxtObs" style="width:720px" rows="<?php GLO_AjustarTextArea($_SESSION['TxtObs'],1,720); ?>" class="TextBox" onKeyPress="event.cancelBubble=true;"><?php echo $_SESSION['TxtObs']; ?></textarea> </td></tr>
<tr><td height="18"  align="right"  valign="top" >&nbsp;Evaluacion:</td><td  > &nbsp; <textarea name="TxtObsEval" style="width:720px" rows="<?php GLO_AjustarTextArea($_SESSION['TxtObsEval'],1,720); ?>" class="TextBox" onKeyPress="event.cancelBubble=true;"><?php echo $_SESSION['TxtObsEval']; ?></textarea> </td></tr>
<tr><td height="18"  align="right"  >&nbsp;Const.Entrega:</td><td  > &nbsp; <input name="TxtObsCE" type="text"  class="TextBox" style="width:720px" maxlength="150"  value="<?php echo $_SESSION['TxtObsCE']; ?>"></td></tr>
<tr><td height="18"  align="right"  valign="top" >Cobranzas:</td><td  > &nbsp; <textarea name="TxtObsCO" style="width:720px" rows="<?php GLO_AjustarTextArea($_SESSION['TxtObsCO'],1,720); ?>" class="TextBox" onKeyPress="event.cancelBubble=true;"><?php echo $_SESSION['TxtObsCO']; ?></textarea> </td></tr>
</table>
