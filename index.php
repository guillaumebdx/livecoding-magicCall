<?php
require_once 'BribeModel.php';

$bribeModel = new BribeModel();
$xaviers = $bribeModel->findByName(['Xavier', 'Karine']);

var_dump($xaviers);
