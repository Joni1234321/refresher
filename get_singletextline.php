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
SELECT topic.initials, textline.text, textline.id, textline.session
FROM textline
INNER JOIN topic
ON topic.id = textline.topic_id
WHERE textline.id = ?
";
$textlines = $db->query($sql, "i", array($q));

if (!isset($textlines)){
    echo "<b> Empty ...  </b>";
    return;
}
$textlines_ids = array();
foreach ($textlines as $tl) {

    // Print textlines
    print_textlines($tl);
    array_push($textlines_ids, $tl["id"]);    

}

// GET SESSION
$sql ="
    SELECT MAX(session) as highestSession
    FROM textline
";

$result = $db->query_no_params($sql);
$maxSession = $result[0]["highestSession"];
$currentSession = $maxSession + 1;

$in = '(' . implode(',', $textlines_ids) .')';
$sql = "
UPDATE textline
SET textline.session = " . $currentSession  . " 
WHERE textline.id IN
" . $in;

// Update oldsession to current session 
$db->query_no_params_no_return($sql);


// Prints the textlines
function print_textlines ($tl) {

    $id       = $tl["id"];
    $initials = $tl["initials"];
    $text     = $tl["text"];

    echo "<div id=" . $id . " class='data_obj'>";
    // Delete
    echo "<div class='del delete'>";
    echo "<b class='del'> / </b>";
    echo "</div>";
    // Topic
    echo "<p class='topic'> " . $initials . " </p>";
    // Textline
    echo "<p class='textline'> " . $text . " </p>";

    echo "</div>";
}


?>