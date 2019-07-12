<?php
$xmlname = $_GET['file'];
$xmldata = simplexml_load_file("$xmlname") or die("Failed to load");

//print_r($xmldata);
//var_dump(get_object_vars($xmldata));
?>
<table border="1">
<?php
foreach($xmldata as $data){
    //echo $data->attributes() . "-----";
    //echo $data->attributes()['type'] . "----";
    echo "<tr>";
    echo "<td>";
    echo $data->children();
    echo "</td>";
    echo "</tr>";
}
?>
</table>
<?php
/*
$i=0;
foreach($xmldata as $empl) {         s      
 echo $empl['loc'][$i]['@attributes']['id'];
 $i++; 
} 
*/
?>