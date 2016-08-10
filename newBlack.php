<?php
// Black Scholes Merton formula
// Developed by Venkatasubbarao Thota.
$call_put_flag=$_GET['radiobutton'];

$S=$_GET['S'];
$X=$_GET['X'];
$T=$_GET['T'];
$r=$_GET['r'];
$v=$_GET['v'];

// The cumulative normal distribution function
function CND ($x) {
$Pi = 3.141592653589793238;
$a1 = 0.319381530;
$a2 = -0.356563782;
$a3 = 1.781477937;
$a4 = -1.821255978;
$a5 = 1.330274429;
$L = abs($x);
$k = 1 / ( 1 + 0.2316419 * $L);
$p = 1 - 1 / pow(2 * $Pi, 0.5) * exp( -pow($L, 2) / 2 ) * ($a1 * $k + $a2 * pow($k, 2) + $a3 * pow($k, 3) + $a4 * pow($k, 4) + $a5 * pow($k, 5) );

if ($x >= 0) {
return $p;
} else {
return 1-$p;
}
}
// The Black and Scholes (1973) Stock option formula
function BlackScholes ($call_put_flag, $S, $X, $T, $r, $v)
{
$r= $r / 100;
$v = $v / 100;
$d1 = ( log($S / $X) + ($r + pow($v, 2) / 2) * $T ) / ( $v * pow($T, 0.5) );
$d2 = $d1 - $v * pow($T, 0.5);
if ($call_put_flag == 'c') {
return $S * CND($d1) - $X * exp( -$r * $T ) * CND($d2);
$nom = "Call Price";
} else {
return $X * exp( -$r * $T ) * CND(-$d2) - $S * CND(-$d1);
$nom = 4;
//"Put Price";
}
}
if ( $S * $X * $T * $r * $v <> 0){
if ($call_put_flag == 'c') {
$nom = "Call Price";
}
 else {
$nom = "Put Price";}
$resultat = BlackScholes($call_put_flag, $S, $X, $T, $r, $v);
echo("<p>$nom : $resultat </p>");
echo("<p>Spot: $S <br>");
echo("<p>Strike: $X <br>");
echo("<p>$T Years to Maturity<br>");
echo("<p>Risk free rate: $r % <br>");
echo("<p>Volatitlty: $v %</p>");
} else {
echo("<p>Fill <b>all</b> the blanks</p>");
}
?>