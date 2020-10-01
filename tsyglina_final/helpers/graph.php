<?php 
include '../config.php';
include ("../src/jpgraph.php"); 
include ("../src/jpgraph_bar.php");
include ("../src/jpgraph_line.php") ; 

$sql=mysqli_query($connection, "SELECT DISTINCT date 
FROM `order` o;") or die("Здесь ошибка: ".mysqli_error($connection));
$dates=array();
while($d=mysqli_fetch_array($sql))
array_push($dates,$d[0]);

$yres=array();

for($i=0;$i<count($dates);$i++){
	$dt=$dates[$i];
	$sql=mysqli_query($connection,"SELECT * FROM `order` o WHERE date LIKE '$dt'") or die ("ОШИБКАААА  ".mysqli_error($connection));
	$row=mysqli_num_rows($sql);
	array_push($yres,$row);
}


$xdata=$dates;
$ydata = $yres; 

$graph = new Graph(600,300,"auto"); 

$graph->SetScale("textlin"); 
$graph->SetShadow(true, 3, array(222,222,222)); 
$graph->img->SetMargin(40,30,20,40); 
$graph->SetMarginColor('white');  
$graph->SetFrame(true,'gray',1); 
$bplot = new BarPlot($ydata); 
$bplot->SetFillColor("orange");  
$bplot->value->Show(); 
$bplot->value->SetFormat('%d'); 
$bplot->value->SetColor('#7BA857'); 
$bplot->SetWidth(0.5);  
$graph->Add($bplot); 
$graph->SetBox(true, '#7BA857'); 
$graph->xgrid->Show(); 
$graph->xgrid->SetLineStyle('dashed'); 
$graph->xgrid->SetColor('gray'); 
$graph->ygrid->SetLineStyle('dashed'); 
$graph->ygrid->SetColor('gray'); 
$graph->xaxis->HideTicks(); 
$graph->yaxis->HideTicks();  
$graph->xaxis->SetColor('#7BA857', '#7BA857'); 
$graph->yaxis->SetColor('#7BA857', '#7BA857');  
$graph->xaxis->SetTickLabels($xdata);
$graph->yaxis->scale->SetGrace(10); 

$graph->Stroke(); 
?>