<?php
$remaining = unserialize(file_get_contents("remaining.txt"));

$bgimg = $_GET['image'];

$remaining = array_values(array_diff($remaining,array($bgimg)));

#array_shift($remaining);

$dir = 'images/';
$images = array();
function imageList(){
  foreach(glob('images/*.*') as $filename){
    $images[] = basename($filename);
  }
  return $images;
}
$image_data = serialize(imageList());

if(empty($remaining)){
	file_put_contents("remaining.txt",$image_data);
}else{
	file_put_contents("remaining.txt",serialize($remaining));
}

?>