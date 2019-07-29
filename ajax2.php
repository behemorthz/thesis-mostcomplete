<?php
// $arr_file_types = ['txt'];
 
// if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
//   echo "false";
//   return;
// }

if (!file_exists('uploads')) {
  mkdir('uploads', 0777);
}
 
$filename = time() . '_' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename);
 
header( "location: cexamplegenerator.php?file=$filename");
exit(0);

?>