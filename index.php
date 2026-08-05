<?php 
$x = 56;
$y = 8;

$array = ["ali","mohammad","reza","fatemeh"];

foreach($array as $names){
    echo"$names <br>";
}

function add($a,$b){
    $c = $a + $b ;
    echo "$a <br> $b";
    return $c;
}

$num = add(5,6);
echo "<br> $num <br>";

$z = 9;
$a = 10;

function global1(){
    global $z,$a;
    $a -=$z;
    return $a;
}

echo global1();

echo"<br>";

function myTest(){
    static $x = 0;
    echo $x;
    $x++;
}

for($i=0; $i<6; $i++){
    myTest();
}
?>
