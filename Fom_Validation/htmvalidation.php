<?php
$myname = "My name 'is' <strong> Bharat </strong><br>";
echo $myname;
// echo htmlsentities($myname);
// echo htmlsentities($myname, ENT_QUOTES);
echo htmlentities($myname,ENT_COMPAT);
// echo htmlentities($myname,ENT_NOQUOTES);

// Decoding html entities
echo "<br>";
echo html_entity_decode(htmlentities($myname,ENT_QUOTES));
//HTML special chars
echo "<br>";
echo htmlspecialchars($myname)."<br>";
echo html_entity_decode(htmlspecialchars($myname))."<br>";
print_r( get_html_translation_table(HTML_ENTITIES) );
echo "<br>";
print_r( get_html_translation_table(HTML_SPECIALCHARS) );
?>