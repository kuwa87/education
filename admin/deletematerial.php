<?php
session_start();
include '../classes/Material.php';
$materialID = $_GET['materialID'];
$material = new Material;
$row = $material->get_material_by_materialID($materialID);
$delete = $material->delete($materialID);
