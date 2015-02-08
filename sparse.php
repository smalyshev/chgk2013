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
	$row['komanda'] = str_replace(array('\\', '"'), '', $row['komanda']);
	echo "<li>{$row['igrok']} ({$row['komanda']})\n";
}

echo "<ul>\n";

$fp = fopen($argv[1], "r");
while($row = get_row($fp)) {
	$rows[] = $row;
}
usort($rows, function ($a, $b) { $aparts = explode(' ', $a['igrok']); $bparts = explode(' ', $b['igrok']); return strcmp($aparts[count($aparts)-1], $bparts[count($bparts)-1]); });
foreach($rows as $row) {
process($row);
}

echo "</ul>\n";
