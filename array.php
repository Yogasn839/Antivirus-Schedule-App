<?php 
$array = array("1" => "surabaya", "2"=>"malang","3"=>"bali","4"=>"semarang");
echo"<h4>Data Sebelum di sort</h4>";
foreach ($array as $key ) {
	echo "<pre>".print_r($key,1)."</pre>";
}
sort($array);
echo"<h4>Data sesudah di sort</h4>";
 foreach ($array as $key ) {
 	echo "<pre>".print_r($key,1)."</pre>";
 }

?>