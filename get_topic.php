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

// Get topic id
$sql = "
    SELECT textline.topic_id
    FROM textline
    WHERE textline.id = ?
";

$result = $db->query($sql, "i", array($q));

if (!isset($result)) {
    echo "<b> Empty ... </b>";
    return;
}

$topic_id = $result[0];

// Get description and initials
$sql = "
    SELECT topic.description, topic.initials
    FROM topic
    WHERE topic.id = ?
";

$result = $db->query($sql, "i", array($topic_id));

if (!isset($result)) {
    echo "<b> Empty ... </b>";
    return;
}
$result = $result[0];

$description = $result["description"];
$initials    = $result["initials"];

echo "<div id=" . $q . " class='topic'>";

// Topic
echo "<p class='initials'> " . $initials . " </p>";
// Textline
echo "<p class='description'> " . $description . " </p>";

echo "</div>";


?>