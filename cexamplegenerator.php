<?php

//$name = $_GET['file'];
//$keep = file("uploads/".$name);
$keep = file("uploads/counter2.txt");
$j = count($keep);
$print = array();

for($k=0;$k<$j;$k++){
    if(preg_match('/.pml:/',$keep[$k])){
        $print = htmlentities($keep[$k]);
    }    
}

$split_print = explode(' ', $print);
$m_array = implode(preg_grep('/.pml/', $split_print));
$result_array = explode(':', $m_array);

$xml = simplexml_load_file('nsbase.xml');
if ($xml->xpath('//loc[@lc_id]')[$result_array[1]]) {
    if($xml->xpath('//loc[@trace]')[0]){
        $xml->xpath('//loc[@trace]')[0]->attributes()['trace'] = "true";
    }
}    
$xml->asXML('nsbase.xml');

?>