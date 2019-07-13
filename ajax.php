<?php
$arr_file_types = ['application/octet-stream'];
 
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
  echo "false";
  return;
}

if (!file_exists('uploads')) {
  mkdir('uploads', 0777);
}
 
$filename = time() . '_' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $filename);
 
header( "location: basegenerator.php?file=$filename");
exit(0);

?>