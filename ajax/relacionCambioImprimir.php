<?PHP
	$canal=$_POST['datos_a_enviar'];
	switch($canal)
	{
		case 1:
			$Titulo  = 'CONTADO';
			$Titulo1 = 'CR&Eacute;DITO';
			$Empresa = 'MA';
			break;
		case 4:
			$Titulo  = 'TC12M';
			$Titulo1 = 'CR&Eacute;DITO';
			$Empresa = 'VIU';
			break;
		case 5:
			$Titulo  = 'MAYO LOCAL';
			$Titulo1 = 'MAYO FORAN';
			$Empresa = 'MAVI';
	}

		$sucursales=$_POST["cbosuc"];
		$etiquetas=$_POST["cboetiq"];

		
	if ($sucursales!='')
	{
		$left=" inner join (select 
						CAST(SUBSTR(almacen,2,10)AS UNSIGNED) as sucursal,
						codigo,
						sum(existencia) as total 
					from  maviglobal.existenciasxsuc 
					where CAST(SUBSTR(almacen,2,10)AS UNSIGNED) = ".$sucursales." 
					group by almacen,codigo having (sum(existencia)>0))as  s on s.codigo=i.CODI ";
	}
	IF($etiquetas!='')
	{
		$where= " AND (case when  length(i.DiseCred) > 0 then i.DiseCred else i.DiseCont end)=".utf8_decode($etiquetas);
	}
	
#conexiones:

	//mysql_connect( "localhost" , "root" , "" ) or die("ERROR connect: " . mysql_error( ) );
	mysql_connect( "localhost" , "webmaster" , "W3b808156" ) or die("ERROR connect: " . mysql_error( ) );
	mysql_select_db('selp-desk-intelisis');

#Primer Query
			$Sql="
					select i.N_Estrategia, i.GRUPLIST, i.CODI, i.NOMB, i.CREDITO, i.12MTC, i.CONTADO, i.CONT_VIU, i.Fecha
					from(select (case when   length(i.DiseCred) > 0 then i.DiseCred else i.DiseCont end) AS N_Estrategia,
							i.GRUPLIST,
							min(i.CODI) as CODI,
							i.NOMB,
							case when i.GRUPLIST = 5 then i.mayofora else i.PRECPPP01 end AS CREDITO,
							case when i.DifePrec01 is null then 0 else i.DifePrec01 end as 12MTC,
							case when i.GRUPLIST = 1 then case when i.CONTADO is null then 0 else i.CONTADO end
								else case when i.GRUPLIST = 4 then case when i.difeprec01 is null then 0 else i.difeprec01 end 
										else case when i.MAYOLOCA then 0 else i.MAYOLOCA end 
									end
							end AS CONTADO,
							case when i.GrupList=4 then i.Contado else i.Contado end AS CONT_VIU,
							max(ia.fecha) as Fecha, i.Fami, i.Line
						from `selp-desk-intelisis`.items i
						INNER JOIN `selp-desk-intelisis`.items_anexos ia on i.codi=ia.codi and i.gruplist=ia.gruplist
						".$left."
						WHERE ia.CODI NOT LIKE 'ESPE%' AND ia.CODI NOT LIKE 'NVO%' and i.GRUPLIST = ".$canal."
							AND ia.ListCred NOT IN (select lista from `selp-desk-intelisis`.listas_relacion_anexos_deshabilitadas) 						
							".$where." 
							and i.Nomb like '%-q-%'
						GROUP BY i.GRUPLIST,
							SUBSTRING(SUBSTRING_INDEX(replace(i.Nomb,' ',''), '-Q-', 2),LENGTH(SUBSTRING_INDEX(replace(i.Nomb,' ',''), '-Q-', 1))+4,LENGTH(SUBSTRING(SUBSTRING_INDEX(replace(i.Nomb,' ',''), '-Q-', 2),LENGTH(SUBSTRING_INDEX(replace(i.Nomb,' ',''), '-Q-', 1))+4))-4)
						union all
						select *
						from(
							select (case when length(i.DiseCred) > 0 then i.DiseCred else i.DiseCont end) AS N_Estrategia,
									i.GRUPLIST,
									min(i.CODI) as CODI,
									min(i.NOMB) as NOMB,
									case when i.GRUPLIST = 5 then i.mayofora else i.PRECPPP01 end AS CREDITO,
									case when i.DifePrec01 is null then 0 else i.DifePrec01 end as 12MTC,
									case when i.GRUPLIST = 1 then case when i.CONTADO is null then 0 else i.CONTADO end
										else case when i.GRUPLIST = 4 then case when i.difeprec01 is null then 0 else i.difeprec01 end 
												else case when i.MAYOLOCA then 0 else i.MAYOLOCA end 
											end
									end AS CONTADO,
									case when i.GrupList=4 then i.Contado else i.Contado end AS CONT_VIU,
									max(ia.fecha) as Fecha,
									i.Fami, i.Line
							from `selp-desk-intelisis`.items i
							INNER JOIN `selp-desk-intelisis`.items_anexos ia on i.codi=ia.codi and i.gruplist=ia.gruplist
							".$left."
							WHERE ia.CODI NOT LIKE 'ESPE%' AND ia.CODI NOT LIKE 'NVO%' and i.GRUPLIST = ".$canal."
								AND ia.ListCred NOT IN (select lista from `selp-desk-intelisis`.listas_relacion_anexos_deshabilitadas)
								".$where."	
								and i.Nomb not like '%-q-%' and i.Fami = 'CALZADO'
							GROUP BY i.GRUPLIST, SUBSTRING(replace(i.Nomb,' ',''), 1, LENGTH(replace(i.Nomb,' ',''))-4)
							)i
						where N_Estrategia != ''
						union all
						select (case when   length(i.DiseCred) > 0 then i.DiseCred else i.DiseCont end) AS N_Estrategia,
							i.GRUPLIST,
							i.CODI,
							i.NOMB,
							case when i.GRUPLIST = 5 then i.mayofora else i.PRECPPP01 end AS CREDITO,
							case when i.DifePrec01 is null then 0 else i.DifePrec01 end as 12MTC,
							case when i.GRUPLIST = 1 then case when i.CONTADO is null then 0 else i.CONTADO end
								else case when i.GRUPLIST = 4 then case when i.difeprec01 is null then 0 else i.difeprec01 end 
										else case when i.MAYOLOCA then 0 else i.MAYOLOCA end 
									end
							end AS CONTADO,
							case when i.GrupList=4 then i.Contado else i.Contado end AS CONT_VIU,
							max(ia.fecha) as Fecha, i.Fami, i.Line
						from `selp-desk-intelisis`.items i
						INNER JOIN `selp-desk-intelisis`.items_anexos ia on i.codi=ia.codi and i.gruplist=ia.gruplist
						".$left."
						WHERE ia.CODI NOT LIKE 'ESPE%' AND ia.CODI NOT LIKE 'NVO%' and i.GRUPLIST = ".$canal."
							AND ia.ListCred NOT IN (select lista from `selp-desk-intelisis`.listas_relacion_anexos_deshabilitadas) 						
							".$where."	
							and i.Nomb not like '%-q-%' and i.Fami != 'CALZADO'
						GROUP BY i.CODI,i.GRUPLIST
						)i
					ORDER BY i.Fami , i.Line, i.Codi
				";
#Query 2		
			$sqlFecha="Select  DATE_FORMAT(max(fecha),'%e %b %Y ') as fecha from items_anexos WHERE GRUPLIST=".$canal;
			//$sqlFecha="select max(fecha) as fecha from `selp-desk-intelisis`.items_anexos where gruplist=".$canal;
#Query 3:

$SqlDis="select *
			from(SELECT DiseCred as diseno	FROM items_anexos i	WHERE GRUPLIST = ".$canal." GROUP BY DiseCred
				union all 
				SELECT DiseCont as diseno FROM items_anexos i WHERE GRUPLIST = ".$canal." GROUP BY DiseCont
				union all 
				SELECT 'General' as diseno 
				)a
			where ifnull(a.diseno,'')!=''
			order by a.diseno asc";

			
			$Result    = mysql_query( $Sql ) or die( "ERROR METODO traer los datos de la tabla items ultima fecha: " . mysql_error( ) );
			$Result1   = mysql_query( $sqlFecha ) or die( "ERROR METODO traer los datos de la tabla items  fechas max: " . mysql_error( ) );
			$ResultDis = mysql_query( $SqlDis ) or die( "ERROR METODO traer los datos de la tabla diseño: " . mysql_error( ) );
			$fechaMax     = mysql_fetch_assoc( $Result1 );
			
			$cadena='
					<div id="body1" align="center" class="container">
					<div id="thead">
                       RELACION DE CAMBIO DE PRECIOS
                    </div>
					<div id="bordes"><table width="95%" align="center" class="table">
							<tr  style="background-color:#ffffff !important">
								<td colspan="3" align="left">
									Relacion de Cambio de Precios de '.$Empresa.' [&Uacute;ltimo Cambio el d&iacute;a  '.$fechaMax['fecha'].']
								</td>
							</tr>
							<tr>
								<td><lu>'; 
			while ( $rowDis =  mysql_fetch_assoc( $ResultDis ) ) {
				$cadena.='		<li>'. $rowDis['diseno'] .'</li>';
			
			}					
			$cadena.='
								</lu></td>
							</tr>
							<tr>
								<td width="40%" align="right"><b>Etiquetas: </b>'.$etiquetas.'</td><td width="20%">&nbsp;</td>
								<td width="40%" align="left"><b>Sucursal: </b>'.$sucursales.'</td>
							</tr>
							<tr><br>&nbsp;</br></tr>
					</table>';					
			$cadena.='<table width="100%" align="center" >';
			$cadena.='
							<tr style="background-color:#1d768a !important">';
		
		if($canal!=5){
			$cadena.='				<td   align="center" >
									<B style="color:#FFFFFF; font-size:10px">ETIQUETA</B>
								</td>';
		}
		$cadena.='				
								<td align="center" >
									<B style="color:#FFFFFF; font-size:10px">CODIGO</B>
								</td>
								<td  align="center" >
									<B style="color:#FFFFFF; font-size:10px">NOMBRE</B>
								</td>
								
								';
			$cadena.='			<td   align="center" >
									<B style="color:#FFFFFF; font-size:10px">CONT</B>
								</td>';//}
		$cadena.='
								
								<td  align="right" >
									<B style="color:#FFFFFF; font-size:10px">'.$Titulo1.'&nbsp;&nbsp;</B>
								</td>
								<td  align="right" >
									<B style="color:#FFFFFF; font-size:10px">&nbsp;'.$Titulo.'&nbsp;&nbsp;</B>
								</td>
								<td  align="center" >
									<B style="color:#FFFFFF; font-size:10px">FECHA</B>
								</td>
							</tr>';
			$Actual   = array();
			$Historico= array();
			$sqlFecha="select max(fecha) as fecha from `selp-desk-intelisis`.items_anexos where gruplist=".$canal ;
			$sqlf=mysql_query($sqlFecha);
			$fechares=mysql_fetch_assoc($sqlf);
			$fecha=$fechares['fecha'];
			
			
			$Color        = 0;
			while ( $row =  mysql_fetch_assoc( $Result ) ) {
				if ($fecha==$row['Fecha']){
					$Actual[]    = $row['N_Estrategia']."@".$row['CODI']."@".$row['NOMB']."@".$row['CONT_VIU']."@".$row['CREDITO']."@".$row['12MTC']."@".$row['Fecha'];
				}else{
					$Historico[] = $row['N_Estrategia']."@".$row['CODI']."@".$row['NOMB']."@".$row['CONT_VIU']."@".$row['CREDITO']."@".$row['12MTC']."@".$row['Fecha'];
				}
			}
			$ContA=count($Actual);
			//print_r($Actual);
			//pirnt_r($Historico);
			for($i=0;$i < $ContA;$i++){
				$datos=split("@",$Actual[$i]);
				if ($Color == 0){
					$Color=1;
					$cadena.='<tr>';
				}else{
					$Color=0;
					$cadena.='<tr  style="background-color:#CCCCCC; color:#000000" >';
				}
				if ($Arg['canal']!=5){
					$cadena.='		
								
										<td  align="left" >
										<span style="color:#000000; font-size:10px">'.utf8_encode($datos[0]).'</span>
									</td>';
				}
				
					if ($datos[3]== ''){
					 $datos[3]=0;
					}
					if ($datos[4]== ''){
					 $datos[4]=0;
					}
					if ($datos[5]== ''){
					 $datos[5]=0;
					}
					
					$cadena.='		<td  align="center" >
										<span style="color:#000000; font-size:10px">'.$datos[1].'</span>
									</td>
									<td  align="left"  >
										<span style="color:#000000; font-size:10px">'.utf8_encode($datos[2]).'</span>
									</td>
									
									';
			$cadena.='			<td  align="center"  >
										<span style="color:#000000; font-size:10px">$'.@number_format($datos[3], 2 , ".", ",").'&nbsp;&nbsp;</span>
									</td>';//}
		$cadena.='
									
									<td  align="center"  >
										<span style="color:#000000; font-size:10px">$'.@number_format($datos[4], 2 , ".", ",").'&nbsp;&nbsp;</span>
									</td>
									<td  align="center">
										<span style="color:#000000; font-size:10px">$'.@number_format($datos[5], 2 ,".",",").'&nbsp;&nbsp;</span>
									</td>
									<td align="center"  >
										<span style="color:#000000; font-size:8px">'.$datos[6].'</span>
									</td>
								</tr>
												
									';
				
			}	
			$cadena.='   	<tr style="background-color:#000000 !important">
										<td width="100%" align="center" colspan="7">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
									</tr>';
			$ContH=count($Historico);
			for($j=0;$j < $ContH;$j++){
				$datosH=split("@",$Historico[$j]);
				if ($Color == 0){
					$Color=1;
					$cadena.='<tr>';
				}else{
					$Color=0;
					$cadena.='<tr  style="background-color:#CCCCCC; color:#000000" >';
				}
				if ($Arg['canal']!=5){
					$cadena.='		
								
										<td  align="left" >
										<span style="color:#000000; font-size:10px">'.utf8_encode($datosH[0]).'</span>
									</td>';
				}
					if ($datosH[3]== ''){
					 $datosH[3]=0;
					}
					if ($datosH[4]== ''){
					 $datosH[4]=0;
					}
					if ($datosH[6]== ''){
					 $datosH[6]=0;
					}
									
					$cadena.='		<td  align="center" >
										<span style="color:#000000; font-size:10px">'.$datosH[1].'</span>
									</td>
									<td  align="left"  >
										<span style="color:#000000; font-size:10px">'.utf8_encode($datosH[2]).'</span>
									</td>
									
									';
			$cadena.='			<td  align="right"  >
										<span style="color:#000000; font-size:10px">$'.@number_format($datosH[3], 2 , ".", ",").'&nbsp;&nbsp;</span>
									</td>';//}
		$cadena.='
									
									<td  align="right"  >
										<span style="color:#000000; font-size:10px">$'.@number_format($datosH[4], 2 , ".", ",").'&nbsp;&nbsp;</span>
									</td>
									<td  align="right" >
										<span style="color:#000000; font-size:10px">$'.@number_format($datosH[5], 2 ,".",",").'&nbsp;&nbsp;</span>
									</td>
									<td align="center"  >
										<span style="color:#000000; font-size:8px">'.$datosH[6].'</span>
									</td>
								</tr>
												
									';
				
			}	
			
			$cadena.='							</table>
			</div></div>';
			echo $cadena;

	date_default_timezone_set("America/Mexico_City");
	$hoy=date("ymd");
	$time=time();


 ?>
 <html>
	<head>
	 <style type="text/css" media="print">
			@page { size: portrait; }
			
			*{
				font-size:10px;
				padding:0;
				margin:0;
				
			}
			#print{
				font-size:8px;
			}
			
			@media print{
				
				.no_imprimir{
					display:none;
				}
				
			}
	</style>
	<style type="text/css">
			#bordes{
		border-style:solid;
		border:solid 1px;
		border-radus:15px;
		text-align:center;
		border-radius:10px;
		width:95%;
		}
	</style>
	</head>
	<body>
	<body>
  <body id="print" onLoad="window.print()">

    	
    </body>
</html>
<?PHP

?>