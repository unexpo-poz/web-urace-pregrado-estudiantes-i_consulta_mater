
<html>
<head>

<?php
print $noCache; 
print $noJavaScript; 


//include_once("inc/vImage.php");
//include_once('../inc/odbcss_c.php');
include_once ('inc/config.php');
//include_once ('../inc/activaerror.php');
?>

<style type="text/css">
<!--
#prueba {
  overflow:hidden;
  color:#00FFFF;
  background:#F7F7F7;
}

.titulo {
  text-align: center; 
  font-family:Arial; 
  font-size: 13px; 
  font-weight: normal;
  margin-top:0;
  margin-bottom:0;	
}
.tit14 {
  text-align: center; 
  font-family: Arial; 
  font-size: 13px; 
  font-weight: bold;
  letter-spacing: 1px;
  font-variant: small-caps;
}
.instruc {
  font-family:Arial; 
  font-size: 12px; 
  font-weight: normal;
  background-color: #FFFFCC;
}
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#F0F0F0; 
  font-variant: small-caps;
}
.boton {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#e0e0e0; 
  font-variant: small-caps;
  height: 20px;
  padding: 0px;
}
.enc_p {
  color:#FFFFFF;
  text-align: center; 
  font-family:Helvetica; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#3366CC;
  height:20px;
  font-variant: small-caps;
}
.inact {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#F0F0F0;
}
.inact2 {
  text-align: center; 
  font-family:Arial; 
  font-size: 16px; 
  font-weight: normal;
  background-color:#F0F0F0;
}
.act { 
  text-align: center; 
  font-family:Arial; 
  font-size: 11px; 
  font-weight: normal;
  background-color:#99CCFF;
}

DIV.peq {
   font-family: Arial;
   font-size: 9px;
   z-index: -1;
}
select.peq {
   font-family: Arial;
   font-size: 8px;
   z-index: -1;
   height: 11px;
   border-width: 1px;
   padding: 0px;
   width: 84px;
}
.datosp {
  text-align: left; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#F0F0F0; 
  font-variant: small-caps;
}

-->
</style>

<title>ERROR</title>


</head>
<body>

<script type="text/javascript" language="Javascript">
<!-- Begin
document.oncontextmenu = function(){return false}
// End -->
</script> 

<table align="center" border="0" cellpadding="0" cellspacing="1" width="750">
	<tr>
		<td class="inact"><IMG SRC="imagenes/unex15.gif" WIDTH="75" HEIGHT="75" BORDER="0" ALT="">
		</td>
		
		<td class="inact">Universidad Nacional Experimental Polit&eacute;cnica<BR>"Antonio Jos&eacute; de Sucre"<BR>Vicerrectorado&nbsp;<? print $vicerrectorado?><BR><? print $nombreDependencia  ?><BR> <? print $tProceso ?>&nbsp;Lapso&nbsp;<? print $lapsoProceso ?>
		</td>		
	</tr>
	<tr>
		<td class="inact2" colspan="2"><BR><BR><BR><B><FONT SIZE="" COLOR="#FF0000"><U>ATENCION</U></FONT></B></td>
	</tr>
	<tr>
		<td class="inact2" colspan="2"><BR><BR><BR><B><FONT SIZE="" COLOR="#FF0000">Su n&uacute;mero de C&eacute;dula o contraseña de acceso son incorrectos por favor cierre esta ventana y rectifique, si el problema persiste o ha olvidado su contraseña, dir&iacute;jase a URACE.</FONT></B></td>
	</tr>
	<tr>
		<td class="inact2" colspan="2"><BR><BR><INPUT TYPE="reset" value="CERRAR VENTANA" class="boton" onClick="javascript:self.close();"></td>
	</tr>
</body>
</table>
</html>


