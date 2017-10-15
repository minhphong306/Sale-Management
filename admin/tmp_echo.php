<?php

$arr = [];

$nv1 =  ["name" => "Phong",
         "age" => "12"];

$nv2 =  ["name" => "Phong",
         "age" => "12"];

$nv3 =  ["name" => "Phong",
         "age" => "12"];

$arr[] = $nv1;
$arr[] = $nv2;
$arr[] = $nv3;
$arr[] = $nv3;
$arr[] = $nv3;
$arr[] = $nv3;
$arr[] = $nv3;
$arr[] = $nv3;

echo json_encode($arr);