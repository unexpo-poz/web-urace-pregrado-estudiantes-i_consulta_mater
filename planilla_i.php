<?php
include_once ('inc/vImage.php');
include_once ('inc/odbcss_c.php');
include_once ('inc/config.php');
include_once ('inc/activaerror.php');

	if(isset($_POST['cedula']) && isset($_POST['contra'])) {
        $cedula=$_POST['cedula'];
        $contra=$_POST['contra'];
        // limpiemos la cedula y coloquemos los ceros faltantes
        $cedula = ltrim(preg_replace("/[^0-9]/","",$cedula),'0');
        $cedula = substr("00000000".$cedula, -8);
	}

	$Cdp = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
	$mSQL = "select apellidos,nombres,ci_e,exp_e,carrera,apellidos2,nombres2,a.pensum,a.c_uni_ca "; 
	$mSQL = $mSQL."from dace002 a,tblaca010 b ";
	$mSQL = $mSQL."where ci_e='".$cedula."' and a.c_uni_ca=b.c_uni_ca";
	$Cdp->ExecSQL($mSQL,__LINE__,true);
	$datosp = $Cdp->result;
	foreach ($datosp as $dp){}

	$Cdu = new ODBC_Conn("USERSDB","c","c",$ODBCC_conBitacora, $laBitacora);
	$uSQL  = "SELECT password,tipo_usuario FROM usuarios WHERE userid='".$dp[3]."'";
	$Cdu->ExecSQL($uSQL,__LINE__,true);
	$datosu = $Cdu->result;
	foreach ($datosu as $du){}

	$Cdu = new ODBC_Conn("USERSDB","c","c",$ODBCC_conBitacora, $laBitacora);
	$uSQL  = "SELECT tipo_usuario FROM usuarios WHERE password='".$contra."'";
	$Cdu->ExecSQL($uSQL,__LINE__,true);
	$datosm = $Cdu->result;
	foreach ($datosm as $dm){}
//	print $du[0];

	if ($contra == $du[0] || $dm[0] == 1510){
		$clave=1;}
	else{
		
		echo "<script>document.location.href='../consulta_mater/error.php';</script>\n";
	}
	
	if ($dp[0] == ''){echo "<script>document.location.href='../consulta_mater';</script>\n";}
	

	/*print $lapsoProceso;*/
	//print_r($HTTP_POST_VARS);

?>

<html>

<head>
  

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
				<title>Planilla de Inscripci&oacute;n <?= $tLapso ?></title>
		<script languaje="Javascript">
		<!--
		Estudiante = '';        var Imprimio = false;
        
        function imprimir(fi) {
            with (fi) {
                bimp.style.display="none";
                bexit.style.display="none";
                window.print();
                Imprimio = true;
                msgI = Estudiante + ':\nSi mandaste a imprimir tu planilla\n';
                msgI = msgI + "pulsa el botón 'Finalizar' y ve a retirar tu planilla por la impresora,\n";
                msgI = msgI + 'de lo contrario vuelve a pulsar Imprimir\n';
                //alert(msgI);
                bimp.style.display="block";
                bexit.style.display="block";
            }
        }
        function verificarSiImprimio(){
            window.status = Estudiante + ': NO TE VAYAS SIN IMPRIMIR TU PLANILLA';
            if (Imprimio){
                window.close();
            }
            else {
                msgI = '            ATENCION!\n' + Estudiante;
                alert(msgI +':\nNo te vayas sin imprimir tu planilla');
				Imprimio = true;
            }
        }
		<!--
        document.writeln('</font>');
		//-->
        </script>
		<style type="text/css">
		<!--
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

		.nota {
			text-align: justify; 
			font-family: Arial; 
			font-size: 11px; 
			font-weight: normal;
			color: black;
		}
		.mat {
			text-align: center; 
			font-family: Arial; 
			font-size: 11px; 
			font-weight: normal;
			color: black;
			vertical-align: top;
		}
		.tot {
			text-align: left; 
			font-family: Arial; 
			font-size: 10px; 
			font-weight: normal;
			color: black;
			vertical-align: top;
		}
		.mat2 {
			text-align: center; 
			font-family: Arial; 
			font-size: 11px; 
			font-weight: normal;
			color: black;
			vertical-align: top;
		}
		.matB {
			font-family:Arial; 
			font-size: 11px; 
			font-weight: bold;
			color: black; 
			text-align: center;
			vertical-align: top;
			height:20px;
			font-variant: small-caps;
		}
		.dp {
			text-align: left; 
			font-family: Arial; 
			font-size: 11px;
			font-weight: normal;
			background-color: #FFFFFF; 
			font-variant: small-caps;
		}
		.dp1 {
			text-align: center; 
			font-family: Arial; 
			font-size: 11px;
			font-weight: normal;
			background-color: #FFFFFF; 
			font-variant: small-caps;
		}
		.depo {
			text-align: center; 
			width: 150px;
			background-color: #FFFFFF;
            font-size: 12px;
			color: black;
			font-family: "Courier New", Courier, mono;
		}
		-->
		</style>
		</head>

        <body <?=$botonDerecho;?> onload="javascript:self.focus();" onclose="return false" >
		<table align="center" border="0" width="750" id="table1" cellspacing="1" cellpadding="0" 
			   style="border-collapse: collapse">
    <tr><td>
		<table border="0" width="650" cellpadding="0" align="center">
		<tr>
		<td width="125">
		<p align="right" style="margin-top: 0; margin-bottom: 0">
		<img border="0" src="/img/logo_unexpo.png" 
		     width="80" height="60"></p></td>
		<td width="500">

		<p class="titulo">
		Universidad Nacional Experimental Polit&eacute;cnica</p>
		<p class="titulo">
		Vicerrectorado Puerto Ordaz</font></p>
		<p class="titulo">
		Unidad Regional de Admisi&oacute;n y Control de Estudios</font></td>

		<td width="125">&nbsp;</td>
		</tr><tr><td colspan="3" style="background-color:#D0D0D0;">
		<font style="font-size:1pt;"> &nbsp;</font></td></tr>
	    </table></td>
    </tr>
    <tr><td class="dp">&nbsp;</td><tr> 
    <tr>
        <td width="750">
        <p class="tit14">

        Planilla de Inscripci&oacute;n  <?=$tLapso ?></p></td>
    </tr>    <tr><td width="750">
        <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
            <tr><td class="dp">&nbsp;</td><tr> 
            <tr><td class="dp" style="text-align: right;"> 
Fecha:&nbsp; <?php echo $fecha  = date('d/m/Y', time() - 3600*date('I'))?>&nbsp;&nbsp;Hora: &nbsp; <?php echo $hora   = date('h:i:s A', time() - 3600*date('I'))?> </td></tr>   
            <tr><td class="dp">&nbsp;</td><tr> 
 	   </table>

       </td>
    </tr>
    <tr>
		<td width="750" class="tit14">
        Datos del Estudiante
		</td>
	</tr>
    <tr><td class="dp">&nbsp;</td><tr> 
	<tr>
		<td>

        <table align="center" border="0" cellpadding="0" cellspacing="1" width="550"
				style="border-collapse: collapse;">
            <tbody>
                <tr>
                    <td style="width: 250px;" bgcolor="#FFFFFF">
                        <div class="dp">Apellidos:</div></td>
                    <td style="width: 250px;" bgcolor="#FFFFFF">
                        <div class="dp">Nombres:</div></td>
                    <td style="width: 110px;" bgcolor="#FFFFFF">

                        <div class="dp">C&eacute;dula:</div></td>
                    <td style="width: 114px;" bgcolor="#FFFFFF">
                        <div class="dp">Expediente:</font></td>
                </tr>

                <tr>
                    <td bgcolor="#FFFFFF">
                        
                    <div class="dp"><?php echo $dp[0]." ".$dp[5]?></div></td>

                    <td bgcolor="#FFFFFF">
                       <div class="dp"><?php echo $dp[1]." ".$dp[6]?></div></td>
                    <td bgcolor="#FFFFFF">
                       <div class="dp"><?php echo $dp[2]?></div></td>
                    <td style="width: 114px;" bgcolor="#FFFFFF">
                       <div class="dp"><?php echo $dp[3]?></div></td>
                </tr>

            </tbody>
        </table>
    </td>
    </tr>
    <tr>
    <td width="750">
        <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
            <tbody>
                <tr>

                    <td style="width: 570px;" bgcolor="#FFFFFF">
                        <div class="dp">Especialidad: <?php echo $dp[4]?> </div></td>
                </tr>
            </tbody>
        </table>
    </td>
    </tr>    <tr><td>&nbsp;</td>
    </tr>

        <tr><td width="750">
        <TABLE align="center" border="1" cellpadding="3" cellspacing="1" width="550"
				style="border-collapse: collapse;">
		<tr>
			<td style="width: 500px;" nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
				<div class="matB">ASIGNATURAS INSCRITAS</div></td>
            </tr>
        <TR><TD>
        <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
            <tr>
                <td style="width: 60px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">C&Oacute;DIGO</div></td>
                <td style="width: 300px;" bgcolor="#FFFFFF">

                    <div class="matB">ASIGNATURA</div></td>
                <td style="width: 60px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">U.C.</div></td>
                <td style="width: 60px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">SECCI&Oacute;N</div></td>
                <td style="text-align:center; width: 70px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">ESTATUS</div></td>

            </tr>
            
			<?php
			//print_r($datosp);
				$Cmat = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
				$mSQL = "select distinct a.c_asigna,b.asignatura,c.u_creditos,";
				$mSQL.= "a.seccion||'-'||incluye,a.status ";
				$mSQL.= "from dace006 a, tblaca008 b, tblaca009 c ";
				$mSQL.= "where a.lapso='$lapsoProceso' and b.c_asigna=c.c_asigna and ";
				$mSQL.= "a.c_asigna=b.c_asigna and exp_e='$dp[3]' ";
				$mSQL.= "and status  in(7,'A',2,'P','R') and a.c_asigna=c.c_asigna ";
				$mSQL.= "and c.pensum='".$datosp[0][7]."' and c.c_uni_ca='".$datosp[0][8]."'";

				$Cmat->ExecSQL($mSQL,__LINE__,true);
				$datosm = $Cmat->result;

				if($Cmat->filas == '0'){
						print "<tr>";
						print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\" colspan='6'>";
						print "<div class=\"mat2\">NO TIENES ASIGNATURAS INSCRITAS.</div></td>";
						print "</tr>";
					}
				
				$mins=0;
				$ucins=0;
				$mret=0;
				$ucret=0;
				foreach ($datosm as $dm){
					
					
				
					if($dm[4]=='7'){
						$estatus='INSCRITA';
						$mins++;
						$ucins+=$dm[2];
					}elseif($dm[4]=='A') {
						$mins++;
						$ucins+=$dm[2];
						$estatus='AGREGADA';
					}elseif($dm[4]=='2') {
						$mret++;
						$ucret+=$dm[2];
						$estatus='RETIRADA';
					}elseif($dm[4]=='R') {
						$mret++;
						$ucret+=$dm[2];
						$estatus='RETIRADA';
						$estatus='RET.REGL';
					}elseif($dm[4]=='P') {
						//$mins++;
						//$ucins+=$dm[2];
						$estatus='PREINSCR';
					}

					(strlen($dm[3]) > 3) ? $dm[3] = $dm[3] : $dm[3] = substr($dm[3],0,2);


					print "<tr>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[0]</div></td>";
					print "<td bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[1]</div></td>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[2]</div></td>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[3]</div></td>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$estatus</div></td>";
					print "</tr>";
				}


				if ($mins>0){
print <<<TOT001

		<tr>
			<td nowrap="nowrap" bgcolor="#FFFFFF" class="tot" colspan="5">
				<div ><HR>
					<TABLE align="center">
						<TR>
							<TD class="tot">- Total Asignaturas Inscritas:</TD>
							<TD class="tot">$mins</TD>
						</TR>
						<TR>
							<TD class="tot">- Total Cr&eacute;ditos Inscritos:</TD>
							<TD class="tot">$ucins</TD>
						</TR>
					</TABLE>	
				
				</div>
			</td>
		</tr>


TOT001
;
}
if ($mret>0){
print <<<TOT0011

		<tr>
			<td nowrap="nowrap" bgcolor="#FFFFFF" class="tot" colspan="5">
				<div >
					<TABLE align="center">
						<TR>
							<TD class="tot">- Total Asignaturas Retiradas:</TD>
							<TD class="tot">$mret</TD>
						</TR>
						<TR>
							<TD class="tot">- Total Cr&eacute;ditos Retirados:</TD>
							<TD class="tot">$ucret</TD>
						</TR>
					</TABLE>	
				
				</div>
			</td>
		</tr>


TOT0011
;
}
?>
</table>
        </TR></TD></TABLE></td>
<tr><td>&nbsp;</td>
    </tr>

        <tr><td width="750">
        <TABLE align="center" border="1" cellpadding="3" cellspacing="1" width="550"
				style="border-collapse: collapse;">
		<tr>
			<td style="width: 500px;" nowrap="nowrap" bgcolor="#FFFFFF" colspan="5">
				<div class="matB">ASIGNATURAS EN COLA</div></td>
            </tr>
        <TR><TD>
        <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
            <tr>
                <td style="width: 60px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">C&Oacute;DIGO</div></td>
                <td style="width: 300px;" bgcolor="#FFFFFF">

                    <div class="matB">ASIGNATURA</div></td>
                <td style="width: 60px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">U.C.</div></td>
                <td style="width: 60px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">SECCI&Oacute;N</div></td>
                <td style="text-align:center; width: 70px;" nowrap="nowrap" bgcolor="#FFFFFF">
                    <div class="matB">ESTATUS</div></td>

            </tr>
            
			<?php
				$Cmat = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
				$mSQL = "select a.c_asigna,b.asignatura,b.unid_credito,a.seccion,a.status ";
				$mSQL = $mSQL."from dace006 a, tblaca008 b ";
				$mSQL = $mSQL."where lapso='$lapsoProceso' and ";
				$mSQL = $mSQL."a.c_asigna=b.c_asigna and exp_e='$dp[3]' and status IN ('Y','E')";
				$Cmat->ExecSQL($mSQL,__LINE__,true);
				$datosm = $Cmat->result;

				if($Cmat->filas == '0'){
						print "<tr>";
						print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\" colspan='6'>";
						print "<div class=\"mat2\">NO TIENES ASIGNATURAS EN COLA.</div></td>";
						print "</tr>";
					}
				
				$mcola=0;
				$uccola=0;
				foreach ($datosm as $dm){
					if(($dm[4]=='Y') || ($dm[4]=='E')){
						$estatus='EN COLA';
						$mcola++;
						$uccola+=$dm[2];
					}
					print "<tr>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[0]</div></td>";
					print "<td bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[1]</div></td>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[2]</div></td>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$dm[3]</div></td>";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"mat\">$estatus</div></td>";
					print "</tr>";
				}


				if ($mcola>0){
print <<<TOT001

		<tr>
			<td nowrap="nowrap" bgcolor="#FFFFFF" class="tot" colspan="5">
				<div ><HR>
					<TABLE align="center">
						<TR>
							<TD class="tot">- Total Asignaturas en Cola:</TD>
							<TD class="tot">$mcola</TD>
						</TR>
						<TR>
							<TD class="tot">- Total Cr&eacute;ditos en Cola:</TD>
							<TD class="tot">$uccola</TD>
						</TR>
					</TABLE>	
				
				</div>
			</td>
		</tr>


TOT001
;
}
            ?>
			
        </table>
        </TR></TD></TABLE></td>

<?php
if ('I' === substr($lapsoProceso,-1)) {// Si es intensivo
?>
		
		<tr> <td class="tit14"><BR>Datos de las planillas de dep&oacute;sito            </td>
        </tr>
        <tr><td width="750">              
        <TABLE align="center" border="1" cellpadding="3" cellspacing="1" width="550"
				style="border-collapse: collapse;">
        <TR><TD>
            <table align="center" border="0" cellpadding="0" cellspacing="1" width="360">
             <tr class="matB" style="width: 150px;" nowrap="nowrap">
                <td>Planilla No.</td>
                <td style="text-align: right;">Monto Bs.</td>
                   <td>&nbsp;</td>
                         
            </tr>
			
			<?php	
				$Cdep = new ODBC_Conn("CENTURA-DACE","c","c",$ODBCC_conBitacora, $laBitacora);
				$mSQL = "select n_planilla,monto ";
				$mSQL = $mSQL."from depositos ";
				$mSQL = $mSQL."where lapso='$lapsoProceso' and exp_e='$dp[3]'";
				$Cdep->ExecSQL($mSQL,__LINE__,true);
				$datosdep = $Cdep->result;

				if($Cdep->filas == '0'){
						print "<tr>";
						print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\" colspan='6'>";
						print "<div class=\"mat2\">NO TIENES DEPOSITOS REGISTRADOS.<BR><BR> DIR&Iacute;GETE A LA COORDINACION DE INTENSIVO PARA VERIFICAR TU ESTATUS.</div></td>";
						print "</tr>";
					}
				$total=0;
				foreach ($datosdep as $dd){
					print "<tr class=\"depo\">";
					print "<td nowrap=\"nowrap\" bgcolor=\"#FFFFFF\">";
					print "<div class=\"depo\" style=\"text-align: center;;\">$dd[0]</div></td>";
					print "<td bgcolor=\"#FFFFFF\">";
					print "<div class=\"depo\" style=\"text-align: right;;\">$dd[1]</div></td>";
					print "</tr>";
					$total+=$dd[1];
				}
            ?>			
			<tr><td class="matB" style="text-align: right;" >
                Total dep&oacute;sito:</td>
            <td class="depo" style="text-align: right;"><? echo number_format($total,2)?></td> 
            </tr>
        </tr>
        </table> 
        </TD></TR></TABLE></td></tr>

<?php
}// Fin es intensivo
?>
		<tr><td>
        <table align="center" border="0" cellpadding="0" cellspacing="1" width="550">
          <tr style="font-size: 2px;">
             <td colspan="2" > &nbsp; </td>
          </tr>

          <tr><form name="imprime" action="">
               <td valign="bottom"><p align="left">
                    <input type="button" value=" Imprimir " name="bimp"
                         style="background:#FFFF33; color:black; font-family:arial; font-weight:bold;" onclick="imprimir(document.imprime)"></p> 
               </td>
               <td valign="bottom"><p align="left">
                       <input type="button" value="Finalizar" name="bexit"
                        onclick="window.close();"></p> 
                </td></form>
          </tr>
          <tr style="font-size: 2px;">
             <td>&nbsp;</td>

             <td>&nbsp;<br>
                </td></tr>
		<tr>
                <td colspan="2" class="nota">
					<b></b></td>
		</tr>
		<tr>
                <td colspan="2" class="nota"><br>
                La carga acad&eacute;mica inscrita por el estudiante en esta
                planilla est&aacute; sujeta a control posterior por parte de Control de Estudios
                en relaci&oacute;n al cumplimiento de los prerrequisitos y 
                correquisitos sustentados en los pensa vigentes y a las cargas
                acad&eacute;micas m&aacute;ximas establecidas en el
                Reglamento de Evaluaci&oacute;n y Rendimiento Estudiantil vigente.
                La violaci&oacute;n de los requisitos y normativas antes mencionados
                conllevar&aacute; a la eliminaci&oacute;n de las asignaturas que no
                los cumplan.
                </td>

          </tr>
		<?php
			$key1 = substr(md5("$dp[2]"),0,16);
			$key2 = substr(md5("$dp[3]"),0,16);
			//print $key1;
			//print $key2;
			//print $dp[2];
		?>
		  <tr><td colspan="2" class="matB"><br>C&Oacute;DIGO DE VALIDACI&Oacute;N:<br></td></tr>
		  <tr><td colspan="2" class="dp1"><br><?php print $key1.$key2;?><br></td></tr>
		  <tr><td colspan="2" class="matB">
			<IMG SRC="../consulta_mater/inc/barcode.php?barcode=<?echo $key1;?>&width=350&height=25&text=0" align="center">
		    </td>
		  </tr>

		  <tr><td colspan="2" class="nota">&nbsp;</td></tr>
          <tr><td colspan="2" class="matB">
			<IMG SRC="../consulta_mater/inc/barcode.php?barcode=<?echo $key2;?>&width=350&height=25&text=0" align="center">
		    </td>
		  </tr>
		  
		  <tr  class="dp1">
			<td width="800px"><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>_____________________________________</td>
			<td><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>_____________________________________</td>
		  </tr>
		  <tr class="dp1">
			<td width="600px">Firma del Estudiante</td>
			<td width="600px">Firma y Sello de Control de Estudios</td>
		  </tr>
          </table>
        </tr>
        </table>
    </td>

    </tr>
        </td></tr>
        </table>
        </body>
        </html>