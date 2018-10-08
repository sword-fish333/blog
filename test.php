<?php
date_default_timezone_set("Europe/Bucharest");
 $date=time();

 //echo $time=strftime("%B-%d-%Y -/- %H:%M:%S",$date);
 echo $time2=strftime("%Y-%m-%d -/- %H:%M:%S",$date);

 echo "<br>";
 $a=array('a','b','c');
 echo array_shift($a);
  echo "<br>";
 print_r($a);
print "<br>";
?>

<?php 

$nr=array(1,2,34,5,23);

foreach ($nr as $v) {
	echo "Values are $v"."<br>";
}
?>

<?php 
$asoc=array("car"=>2000,"truck"=>"heavy","metall"=>"rock");
echo "<br>";
echo "the car has ".$asoc['car'];
print "<br>";
print count($asoc);
print "<br>";
foreach($asoc as $x=>$x_value){
	echo $x."=>".$x_value."<br>";
}
echo "<br>";
foreach($asoc as $x){
	echo $x."<br>";
}

echo "<br>";
?>

<?php
$cars=array(
array("VW",20,5),
array("BMW",40,25),
array("Ferrari",10,1)
);
echo "<table>";
for($i=0;$i<count($cars);$i++){
	echo "<tr>";
for($j=0;$j<count($cars[$i]);$j++){
echo "<td>".$cars[$i][$j]."</td> ";
}
echo "</tr>";
}
echo "</table>";
?>

<?php
$v="hello";
$s="$v to you";
echo "<br>";
echo $s;
$s='$v to you';
echo "<br>";
$string='$v man';
print($string);
echo "<br>";
$d="man are you \"ok\" you know\t\t what i say";
print($d);
echo "<br>";
echo strlen($d);
?>
