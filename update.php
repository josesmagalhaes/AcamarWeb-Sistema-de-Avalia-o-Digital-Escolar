<?php date_default_timezone_set('America/Sao_Paulo');?>

<?php 
session_start();
require "conexao.php"; ?>
<?php
include_once 'dbConnection.php';

$email=$_SESSION['email'];
//delete feedback
if(isset($_SESSION['key'])){
if(@$_GET['fdid'] && $_SESSION['key']=='sunny7785068889') {
$id=@$_GET['fdid'];
$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
header("location:dash.php?q=3");
}
}

//delete user
if(isset($_SESSION['key'])){
if(@$_GET['demail'] && $_SESSION['key']=='sunny7785068889') {
$demail=@$_GET['demail'];
$r1 = mysqli_query($con,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM history WHERE email='$demail' ") or die('Error');
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:dash.php?q=1");
}
}
//remove quiz
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='sunny7785068889') {
$eid=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$qid = $row['qid'];
$r1 = mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
}
$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

header("location:dash.php?q=5");
}
}

//add quiz
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='sunny7785068889') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$total = $_POST['total'];
$sahi = $_POST['right'];
$wrong = $_POST['wrong'];
$time = $_POST['time'];
$tag = $_POST['tag'];
$desc = $_POST['desc'];
$id=uniqid();
$q3=mysqli_query($con,"INSERT INTO quiz VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc','$tag', NOW())");

header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
}

//add question
if(isset($_SESSION['key'])){
if(@$_GET['q']== 'addqns' && $_SESSION['key']=='sunny7785068889') {
$n=@$_GET['n'];
$eid=@$_GET['eid'];
$ch=@$_GET['ch'];

for($i=1;$i<=$n;$i++)
 {
 $qid=uniqid();
 $qns=$_POST['qns'.$i];
$q3=mysqli_query($con,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
  $oaid=uniqid();
  $obid=uniqid();
$ocid=uniqid();
$odid=uniqid();
$a=$_POST[$i.'1'];
$b=$_POST[$i.'2'];
$c=$_POST[$i.'3'];
$d=$_POST[$i.'4'];
$e=$_POST[$i.'5'];    
$qa=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
$qb=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
$qc=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
$qd=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
$qe=mysqli_query($con,"INSERT INTO options VALUES  ('$qid','$e','$odid')") or die('Error64');    
$e=$_POST['ans'.$i];
switch($e)
{
case 'a':
$ansid=$oaid;
break;
case 'b':
$ansid=$obid;
break;
case 'c':
$ansid=$ocid;
break;
case 'd':
$ansid=$odid;
case 'e':
$ansid=$odid;        
break;
default:
$ansid=$oaid;
}


$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

 }
header("location:dash.php?q=0");
}
}

//quiz start
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$ans=$_POST['ans'];
$qid=@$_GET['qid'];
$date = date('d/m/yy H:i');

    
    
$q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
while($row=mysqli_fetch_array($q) )
{
$ansid=$row['ansid'];
}
if($ans == $ansid)
{
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$sahi=$row['sahi'];
}
if($sn == 1)
{
$q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
$quant_men = mysqli_query($connect,"SELECT serie FROM estudantes WHERE code = '$email'");
    if (mysqli_num_rows($quant_men)==''){
        $turmaPegar = "";
    }else{
        while($resultados = mysqli_fetch_array($quant_men)){
            $turmaPegar = $resultados['serie'];
        }
    }    

if (($eid=='5ed5531f32482')or($eid=='5ed57e7bc00de')or($eid=='5ed5a5de48186')or($eid=='5ed5b60599bc8')or($eid=='5ed81306e8e33')or($eid=='5ed9388340036')or($eid=='5ed97c6f9bfe1')){//LINGUAGENS
    $aluno= $email;
    $mes='Avaliação-Abril';
    $portugues = "LÍNGUA PORTUGUESA-".$turmaPegar;
    $ingles = "LÍNGUA ESTRANGEIRA INGLÊS-".$turmaPegar;
    $artes = "ARTE-".$turmaPegar;
    $espanhol="LÍNGUA ESTRANGEIRA ESPANHOL-".$turmaPegar;
    $educacaofisica="EDUCAÇÃO FÍSICA-".$turmaPegar;
    $insert1=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$portugues')"); 
    $insert2=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$ingles')"); 
    $insert3=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$artes')");     
    $insert4=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$espanhol')");       
    $insert5=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$educacaofisica')");   
}else if (($eid=='5ed577ce75bf3')or($eid=='5ed589d01b7b3')or($eid=='5ed5b2927ee0a')or($eid=='5ed63340dafd2')or($eid=='5ed803edeb209')or($eid=='5ed94365d5fd0')or($eid=='5ed9801d84d0d')){//HUMANAS
    $aluno= $email;
    $mes='Avaliação-Abril';
    $historia = "HISTÓRIA-".$turmaPegar;
    $geografia = "GEOGRAFIA-".$turmaPegar;
    $sociologia = "SOCIOLOGIA-".$turmaPegar;
    $filosofia = "FILOSOFIA-".$turmaPegar;
    $ensreligioso = "ENSINO RELIGIOSO-".$turmaPegar;
    
    $insert6=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$historia')"); 
    $insert7=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$geografia')");
    $insert8=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$filosofia')");
    $insert9=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$sociologia')");
    $insert10=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$ensreligioso')");
} else if (($eid=='5ed56e115188d')or($eid=='5ed585178865a')or($eid=='5ed5ada1c6787')or($eid=='5ed62e7ce4d66')or($eid=='5ed8093edd389')or($eid=='5ed94ff87094b')or($eid=='5ed9841bb3abe')){//NATUREZA
    $aluno= $email;
    $mes='Avaliação-Abril';
    $fisica= "FÍSICA-".$turmaPegar;
    $quimica= "BIOLOGIA-".$turmaPegar;
    $biologia = "QUÍMICA-".$turmaPegar; 
    
    $insert11=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$fisica')"); 
    $insert12=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$quimica')");
    $insert13=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$biologia')");
    
}else if (($eid=='5ed55919904ca')or($eid=='5ed582f5efcd8')or($eid=='5ed5ab3292e28')or($eid=='5ed5b97f8ec1e')or($eid=='5ed8188bbc82f')or($eid=='')or($eid=='5ed969e67fdf9')or($eid=='5ed989fa9d827')){//MATEMATICA
    $aluno= $email;
    $mes='Avaliação-Abril';
    $matematica= "MATEMÁTICA-".$turmaPegar;
    $insert14=mysqli_query($connect,"INSERT INTO notas (nota,aluno,mes,disciplina) VALUES (0,'$aluno','$mes','$matematica')");
    
}
  
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$r=$row['sahi'];
}
$r++;
$s=$s+$sahi;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
$quant_men = mysqli_query($connect,"SELECT serie FROM estudantes WHERE code = '$email'");
    if (mysqli_num_rows($quant_men)==''){
        $turmaPegar = "";
    }else{
        while($resultados = mysqli_fetch_array($quant_men)){
            $turmaPegar = $resultados['serie'];
        }
    }    

if (($eid=='5ed5531f32482')or($eid=='5ed57e7bc00de')or($eid=='5ed5a5de48186')or($eid=='5ed5b60599bc8')or($eid=='5ed81306e8e33')or($eid=='5ed9388340036')or($eid=='5ed97c6f9bfe1')){//LINGUAGENS
    $nota = $r*(0.5);
    $aluno= $email;
    $mes='Avaliação-Abril';
    $portugues = "LÍNGUA PORTUGUESA-".$turmaPegar;
    $ingles = "LÍNGUA ESTRANGEIRA INGLÊS-".$turmaPegar;
    $artes = "ARTE-".$turmaPegar;
    $espanhol="LÍNGUA ESTRANGEIRA ESPANHOL-".$turmaPegar;
    $educacaofisica="EDUCAÇÃO FÍSICA-".$turmaPegar;

    $update_1=mysqli_query($connect,"UPDATE notas SET nota='$nota' WHERE aluno='$aluno' and mes='$mes' and (disciplina='$portugues' or disciplina='$ingles' or disciplina='$artes' or disciplina='$espanhol' or disciplina='$educacaofisica')"); 
    
    
}else if (($eid=='5ed577ce75bf3')or($eid=='5ed589d01b7b3')or($eid=='5ed5b2927ee0a')or($eid=='5ed63340dafd2')or($eid=='5ed803edeb209')or($eid=='5ed94365d5fd0')or($eid=='5ed9801d84d0d')){//HUMANAS
    $nota = $r*(0.5);
    $aluno= $email;
    $mes='Avaliação-Abril';
    $historia = "HISTÓRIA-".$turmaPegar;
    $geografia = "GEOGRAFIA-".$turmaPegar;
    $sociologia = "SOCIOLOGIA-".$turmaPegar;
    $filosofia = "FILOSOFIA-".$turmaPegar;
    $ensreligioso = "ENSINO RELIGIOSO-".$turmaPegar;
    
    $update_2=mysqli_query($connect,"UPDATE notas SET nota='$nota' WHERE aluno='$aluno' and mes='$mes' and (disciplina='$historia' or disciplina='$geografia' or disciplina='$sociologia' or disciplina='$filosofia' or disciplina='$ensreligioso')");     

} else if (($eid=='5ed56e115188d')or($eid=='5ed585178865a')or($eid=='5ed5ada1c6787')or($eid=='5ed62e7ce4d66')or($eid=='5ed8093edd389')or($eid=='5ed94ff87094b')or($eid=='5ed9841bb3abe')){//NATUREZA
    $nota = $r*(0.5);
    $aluno= $email;
    $mes='Avaliação-Abril';
    $fisica= "FÍSICA-".$turmaPegar;
    $quimica= "BIOLOGIA-".$turmaPegar;
    $biologia = "QUÍMICA-".$turmaPegar; 
    $update_3=mysqli_query($connect,"UPDATE notas SET nota='$nota' WHERE aluno='$aluno' and mes='$mes' and (disciplina='$fisica' or disciplina='$quimica' or disciplina='$biologia')");     

    
}else if (($eid=='5ed55919904ca')or($eid=='5ed582f5efcd8')or($eid=='5ed5ab3292e28')or($eid=='5ed5b97f8ec1e')or($eid=='5ed8188bbc82f')or($eid=='5ed969e67fdf9')or($eid=='5ed989fa9d827')){//MATEMATICA
    $nota = $r*(1);
    $aluno= $email;
    $mes='Avaliação-Abril';
    $matematica= "MATEMÁTICA-".$turmaPegar;
    $update_4=mysqli_query($connect,"UPDATE notas SET nota='$nota' WHERE aluno='$aluno' and mes='$mes' and (disciplina='$matematica')"); 
    
}
 
} 
else
{
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');

while($row=mysqli_fetch_array($q) )
{
$wrong=$row['wrong'];
}
if($sn == 1)
{
$q=mysqli_query($con,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
  
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
}
$w++;
$s=$s-$wrong;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
 
}
if($sn != $total)
{
$sn++;
header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
}
else if( $_SESSION['key']!='sunny7785068889')
{
$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
$rowcount=mysqli_num_rows($q);
if($rowcount == 0)
{
$q2=mysqli_query($con,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
}
else
{
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$s+$sun;
$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
}
header("location:account.php?q=result&eid=$eid");
}
else
{
header("location:account.php?q=result&eid=$eid");
}

}
//restart quiz
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
$eid=@$_GET['eid'];
$n=@$_GET['n'];
$t=@$_GET['t'];
$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
$q=mysqli_query($con,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$sun-$s;
$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}

?>



