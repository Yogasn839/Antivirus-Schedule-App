<?php 
$array = array("1" => "surabaya", "2"=>"malang","3"=>"bali","4"=>"semarang");
echo"<h4>Data Sebelum di sort, asort, arsort, ksort, krsort, rsort</h4>";
foreach ($array as $key ) {
	echo "<pre>".print_r($key,1)."</pre>";
}
sort($array);
echo"<h4>Data sesudah di sort</h4>";
 foreach ($array as $key ) {
 	echo "<pre>".print_r($key,1)."</pre>";
 }
asort($array);
echo"<h4>Data sesudah di asort</h4>";
 foreach ($array as $key ) {
 	echo "<pre>".print_r($key,1)."</pre>";
 }
 arsort($array);
echo"<h4>Data sesudah di arsort</h4>";
 foreach ($array as $key ) {
 	echo "<pre>".print_r($key,1)."</pre>";
 }
 ksort($array);
echo"<h4>Data sesudah di ksort</h4>";
 foreach ($array as $key ) {
 	echo "<pre>".print_r($key,1)."</pre>";
 }
 krsort($array);
echo"<h4>Data sesudah di krsort</h4>";
 foreach ($array as $key ) {
 	echo "<pre>".print_r($key,1)."</pre>";
 }
 rsort($array);
echo"<h4>Data sesudah di rsort</h4>";
 foreach ($array as $key ) {
 	echo "<pre>".print_r($key,1)."</pre>";
 }
?>