<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php date_default_timezone_set('America/Sao_Paulo');?>
<?php require "conexao.php"; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Acamar Web | Aluno </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<?php
include_once 'dbConnection.php';
?>
<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">seu sistema de avaliação escolar</span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
 include_once 'dbConnection.php';
session_start();
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];
$result1 = mysqli_query($con,"SELECT college FROM user WHERE name = '$name'");
    while($row1 = mysqli_fetch_array($result1)) {
	$turma = $row1['college'];
  
    
include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Olá,</span> <a href="account.php?q=1" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Sair</button></a></span>';
}?>
</div>
</div></div>
<div class="bg">

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        </ul>
            <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Digite uma turma ">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Buscar</button>
        <?php echo "&nbsp;<strong>Sua turma é: </strong>".$turma ;?> 
      </form>
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="img-profile rounded-circle" src="../acamarweb/image/user/<?php echo $email.".jpg"; ?>" alt="Sem Imagem" onerror="this.src='../acamarweb/image/user/profile.jpg';">

    
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM quiz WHERE tag = '$turma' or tag='TODAS' ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>Code</b></td><td><b>Disciplina</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['tag'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td>
    ';
    $agora= date('d/m/yy H:i');
        //LINGUAGENS DIURNO
    if ((($title=='Linguagens E Suas Tecnologias-D')or($title=='Linguagens E Suas Tecnologias-I'))and($agora>='08/06/2020 08:00' and $agora <= '08/06/2020 09:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>';    
        //HUMANAS DIUUUNO
    }else if ((($title=='Humanas E Suas Tecnologias-D')or($title=='Humanas E Suas Tecnologias-I'))and($agora>='08/06/2020 10:00' and $agora <= '08/06/2020 11:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>'; 
        //NATUREZA DIURNO
    }else if ((($title=='Natureza E Suas Tecnologias-D')or($title=='Natureza E Suas Tecnologias-I'))and($agora>='09/06/2020 08:00' and $agora <= '09/06/2020 09:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>';   
        //MATEMÁTICA DIURNO
    }else if ((($title=='Matemática E Suas Tecnologias-D')or ($title=='Matemática E Suas Tecnologias-I'))and($agora>='09/06/2020 10:00' and $agora <= '09/06/2020 11:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>';      
        //LINGUAGENS NOTURNO
    }else if (($title=='Linguagens E Suas Tecnologias-N')and($agora>='08/06/2020 18:00' and $agora <= '08/06/2020 19:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>';
        //HUMANAS NOTURNO
    }else if (($title=='Humanas E Suas Tecnologias-N')and($agora>='08/06/2020 20:00' and $agora <= '08/06/2020 21:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>'; 
        //NATUREZA NOTURNO
    }else if (($title=='Natureza E Suas Tecnologias-N')and($agora>='22/03/2021 18:00' and $agora <= '30/03/2021 19:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>';    
        //MATEMÁTICA NOTURNO
    }else if (($title=='Matemática E Suas Tecnologias-N')and($agora>='09/06/2020 20:00' and $agora <= '09/06/2020 21:30')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>';       
    }else if (($title=='Prova Teste - Conhecimentos sobre o Coronavírus')and($agora>='07/06/2020 00:00' and $agora <= '08/06/2020 23:59')){
        echo '<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Iniciar</b></span></a></b></td></tr>';       
    }else{
        echo '<td><b><a href="" class="pull-right btn sub1" style="margin:0px;background:#ff0000"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Fechado</b></span></a></b></td></tr>';          
    }    
  
}
else
{
echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
	<td><b><a href="" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Feito</b></span></a></b></td></tr>';
}
}
$c=0;
echo '</table></div>';

}}?>
<!--<span id="countdown" class="timer"></span>
<script>
var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script>-->

<!--home closed-->

<!--quiz start-->
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {

$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];

?>    
<script>
(function(window) { 
  'use strict'; 
 
var noback = { 
	 
	//globals 
	version: '0.0.1', 
	history_api : typeof history.pushState !== 'undefined', 
	 
	init:function(){ 
		window.location.hash = '#no-back'; 
		noback.configure(); 
	}, 
	 
	hasChanged:function(){ 
		if (window.location.hash == '#no-back' ){ 
			window.location.hash = '#BLOQUEIO';
			//mostra mensagem que não pode usar o btn volta do browser
			if($( "#msgAviso" ).css('display') =='none'){
				$( "#msgAviso" ).slideToggle("slow");
			}
		} 
	}, 
	 
	checkCompat: function(){ 
		if(window.addEventListener) { 
			window.addEventListener("hashchange", noback.hasChanged, false); 
		}else if (window.attachEvent) { 
			window.attachEvent("onhashchange", noback.hasChanged); 
		}else{ 
			window.onhashchange = noback.hasChanged; 
		} 
	}, 
	 
	configure: function(){ 
		if ( window.location.hash == '#no-back' ) { 
			if ( this.history_api ){ 
				history.pushState(null, '', '#BLOQUEIO'); 
			}else{  
				window.location.hash = '#BLOQUEIO';
				//mostra mensagem que não pode usar o btn volta do browser
				if($( "#msgAviso" ).css('display') =='none'){
					$( "#msgAviso" ).slideToggle("slow");
				}
			} 
		} 
		noback.checkCompat(); 
		noback.hasChanged(); 
	} 
	 
	}; 
	 
	// AMD support 
	if (typeof define === 'function' && define.amd) { 
		define( function() { return noback; } ); 
	}  
	// For CommonJS and CommonJS-like 
	else if (typeof module === 'object' && module.exports) { 
		module.exports = noback; 
	}  
	else { 
		window.noback = noback; 
	} 
	noback.init();
}(window));     
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div id="msgAviso" style="display:none;">
    <span style="color: #ff0000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Não é permitido voltar questões.</strong></span>
</div>  
<?php     
if(($eid=='5ed5531f32482')or($eid=='5ed57e7bc00de')or($eid=='5ed5a5de48186')or($eid=='5ed5b60599bc8') and($date > '05/05/2020 09:30')){//LINGUAGENS DIURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>9:30 AM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if(($eid=='5ed577ce75bf3')or($eid=='5ed589d01b7b3')or($eid=='5ed5b2927ee0a')or($eid=='5ed63340dafd2') and($date > '08/06/2020 11:30')){//HUMANAS DIURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>11:30 AM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if(($eid=='5ed56e115188d')or($eid=='5ed585178865a')or($eid=='5ed5ada1c6787')or($eid=='5ed62e7ce4d66') and($date > '09/06/2020 09:30')){//NATUREZA DIURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>9:30 AM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if(($eid=='5ed55919904ca')or($eid=='5ed582f5efcd8')or($eid=='5ed5ab3292e28')or($eid=='5ed5b97f8ec1e') and($date > '09/06/2020 11:30')){//MATEMÁTICA DIURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>11:30 AM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if(($eid=='5ed81306e8e33')or ($eid=='5ed9388340036') or ($eid=='5ed97c6f9bfe1')and($date > '08/06/2020 19:30')){//LINGUAGENS NOTURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>19:30 PM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if(($eid=='5ed803edeb209') or ($eid=='5ed94365d5fd0') or ($eid=='5ed9801d84d0d')and($date > '08/06/2020 21:30')){//HUMANAS DIURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>21:30 PM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if(($eid=='5ed8093edd389')or ($eid=='5ed94ff87094b') or ($eid=='5ed9841bb3abe') and($date > '09/06/2020 19:30')){//NATUREZA NOTURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>19:30 PM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if(($eid=='5ed8188bbc82f') or ($eid=='5ed969e67fdf9') or ($eid=='5ed989fa9d827') and($date > '09/06/2020 21:30')){//MATEMATICA DIURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>21:30 PM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}else if($eid=='5edc5cd9c94c8') {//MATEMATICA DIURNO
    echo "<span style='color: #238b35;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ATENÇÃO: </strong>Você tem até as <strong>23:59 PM</strong> para realizar esta avaliação! Quando o tempo acabar, a prova NÃO irá fechar, contudo, você não será mais capaz de responder!</span> ";
}
    
?>        
<?php    
$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=$row['qns'];
$qid=$row['qid'];
echo '<b>QUESTÃO &nbsp;'.$sn.'&nbsp;:<br />'.$qns.'</b><br />';
}
$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$optionid=$row['optionid'];
echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option;
}
echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Fim de avaliação!</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
echo '<tr style="color:#66CCFF"><td><a href="../eescolar/aluno/">Voltar</a></td><td></td></tr>';
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
echo '</table></div>';

}
?>
<!--quiz end-->
<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Code</b></td><td><b>Avaliação</b></td><td><b>Questões resolvidas</b></td><td><b>Certas</b></td><td><b>Erradas<b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

//ranking start
if(@$_GET['q']== 3) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>College</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['gender'];
$college=$row['college'];
}
$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$college.'</td><td>'.$s.'</td><td>';
}
echo '</table></div>';}
?>



</div></div></div></div>

<!--Footer start-->
<div class="row footer">
<div class="col-md-3 box">
<a href="http://sistemashesichia.com.br/" target="_blank">Sistemas Hesíchia</a>
</div>
<div class="col-md-3 box">
<a href="#" data-toggle="modal" data-target="#login">Administrador</a></div>
<div class="col-md-3 box">
<a href="#" data-toggle="modal" data-target="#developers">Desenvolvedor</a>
</div>
<div class="col-md-3 box">
<a href="feedback.php" target="_blank">Feedback</a></div></div>
<!-- Modal For Developers-->
<div class="modal fade title1" id="developers">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Desenvolvedor</span></h4>
      </div>
	  
      <div class="modal-body">
        <p>
		<div class="row">
		<div class="col-md-4">
		 <img src="image/CAM00121.jpg" width=100 height=100 alt="José de Sousa Magalhães" class="img-rounded">
		 </div>
		 <div class="col-md-5">
		<a href="https://github.com/josesmagalhaes" style="color:#202020; font-family:'typo' ; font-size:18px" title="Find on Facebook">José de Sousa Magalhães</a>
		<h4 style="font-family:'typo' ">joses.magalhaes@hotmail.com</h4>
		<h4 style="font-family:'typo' ">Desenvolvedor | Visionário | Técnico de TI</h4></div></div>
		</p>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal for admin login-->
	 <div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
      </div>
      <div class="modal-body title1">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<form role="form" method="post" action="admin.php?q=index.php">
<div class="form-group">
<input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
</div>
<div class="form-group">
<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
</div>
<div class="form-group" align="center">
<input type="submit" name="login" value="Login" class="btn btn-primary" />

</div>
</form>
    
</div><div class="col-md-3"></div></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer end-->


</body>
</html>
