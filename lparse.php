<?php
function get_row($fp) {
	while($s = fgets($fp)) {
		if(substr($s, 0, 6) == "===== ") {
			break;
		}
	}
	if(empty($s)) return false;
	$data = '';
	while($s = fgets($fp)) {
		if(substr($s, 0, 5) == "=====") {
			break;
		}
		$data .= $s;
	}
	$data = trim($data);
	if(empty($data)) return false;
	return json_decode($data, true);
}

function process($row)
{
	$em = explode('@', $row['email']);
	echo "<li>{$row['igrok']} ({$em[0]}<!-- what's this? -->&#064;<!-- This is us, letters -->{$em[1]})\n";
}

echo "<ol>\n";

$fp = fopen($argv[1], "r");
while($row = get_row($fp)) {
	process($row);
}

echo "</ol>\n";
