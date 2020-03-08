<?php 
// Get all the textlines from the database

require_once ("db_file.php");
$db = new DB ();

// get the q parameter from URL
$q = $_REQUEST["q"];
if (!isset($q) || $q == "") {
    echo "No input received";    
    return;
}

$sql = "
DELETE
FROM textline
WHERE textline.id = ?
";

$id = $db->query_id($sql, "i", array($q));
if (!isset($id)){
    echo "Nothing deleted";
}else {
    echo $id;
}

?>