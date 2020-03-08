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
    INSERT INTO textline (topic_id, user_id, text, session)
    VALUES ( 1, 1, ?, 0)
";

$id = $db->query_id($sql, "s", array($q));
if (!isset($id)){
    echo "Nothing created";
}else {
    echo $id;
}
?>