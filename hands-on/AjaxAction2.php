<?php
$p=(int) $_GET['cp'];
$p+=rand(0,2);
if($p>100)
    $p=100;
echo $p;