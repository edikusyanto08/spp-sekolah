<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"></meta>
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #000000;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
    .style5 {color: #000000; font-family: "Times New Roman", Times, serif; font-size: 14; }
    .style6 {color: #FFFFFF}
    .style7 {color: #000000}
    </style>
</head>
<body>

<table width="100%" border="0">
  
  <tr>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center"><strong><font size="+2">REKAP SETORAN UANG MASUK DAN DAFTAR ULANG </font></strong></div></td>
  </tr>
</table>

<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="62%">&nbsp;</td>
    <td width="38%">&nbsp;</td>
  </tr>
  <tr>
    <td>UNIT: <span class="style5">
      <?php //echo $nm_jenjang;
	if ($nm_jenjang==0){ echo "TK-SD-SMP";}
	else if ($nm_jenjang==2){ echo "TK";}
	else if ($nm_jenjang==3){ echo "SD";}
	else if ($nm_jenjang==4){ echo "SMP";}
	?>
    </span></td>
    <td>TANGGAL : <span class="style5"><?php  
	
	 $time=strtotime($per_tanggal);
    echo date("m/d/Y",$time);
	
	
	?> </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1">
  <tr>
    <td width="7%" height="63"><div align="center"><strong>NO</strong></div></td>
    <td width="29%" height="63" align="center"><strong>NAMA</strong></td>
    <td width="13%" height="63"><div align="center"><strong>KELAS</strong></div></td>
    <td width="17%" height="63"><div align="center"><strong>U.MASUK (Rupiah)</strong></div></td>
    <td width="16%"><div align="center"><strong>DAFTAR ULANG (Rupiah)</strong></div></td>
    <td width="18%" height="63"><div align="center"><strong>JUMLAH</strong><strong>(Rupiah)</strong></div></td>
  </tr>
</table>
<?php 

function DisplayDouble($value)
  {
  list($whole, $decimals) = split ('[.,]', $value, 2);
  if (intval($decimals) > 0)
    return number_format($value,2,".",",");
  else
    return number_format($value,0,".",",") .",-";
  }

$i=1;
		foreach($data_dfulang->result() as $row){
		
		?>
<table width="100%" border="1">
  <tr>
    <td width="7%" height="32"><div align="center"><?php echo $i++;?></div></td>
    <td width="29%" height="32"><div align="left"><span class="style6">_</span><?php echo $row->namalengkap;?></div></td>
    <td width="13%" height="32"><div align="center"><?php echo $row->kelas;?></div></td>
    <td width="17%" height="32"><div align="right"><?php $uang_muka=$row->uang_muka; $clean = str_replace(".00", ",-",$uang_muka);echo $clean;?><span class="style6">.</span></div>    </td>
    <td width="16%"><div align="right"><?php $uang_daftar=$row->uang_daftar; $clean1 = str_replace(".00", ",-",$uang_daftar);echo $clean1;?><span class="style6">.</span></div></td>
    <td width="18%" height="32"><div align="right"><span class="style6"><span class="style7"><?php  $total=$row->total;$clean2 = str_replace(".00", ",-",$total);echo $clean2;?></span>.</span></div></td>
  </tr>
</table>
<?php }?>
<table width="100%" border="1">
  <tr>
    <td width="7%" height="32"><div align="center"></div></td>
    <td width="42%"><div align="center">TOTAL JUMLAH </div></td>
    <td width="17%"><div align="right">
      <?php foreach($data_um->result() as $row){?>
      <?php $total=$row->total;$clean2 = str_replace(".00", ",-",$total);echo $clean2;?>
      <?php }?>
    </div>    </td>
    <td width="16%"><div align="right">
      <?php foreach($data_du->result() as $row){?>
      <?php $total=$row->total;$clean2 = str_replace(".00", ",-",$total);echo $clean2;?>
      <?php }?>
    </div></td>
    <td width="18%"><div align="right">
      <?php foreach($data_total->result() as $row){?>
      <?php $total=$row->total;$clean2 = str_replace(".00", ",-",$total);echo $clean2;?>
      <?php }?>
    </div></td>
  </tr>
</table>
</body>
</html>
