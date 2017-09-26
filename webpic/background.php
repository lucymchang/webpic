<?php
$remaining = unserialize(file_get_contents("remaining.txt"));
$rimg = $remaining[0];

echo $rimg;
?>