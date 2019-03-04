<?php
$count = 0;
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
	global $count; 
	$row['igroki'] = strtr($row['igroki'], ",","\n");
	$igroki = array_map("trim", explode("\n", trim($row['igroki'])));
	if(($pos = array_search($row['kapitan'], $igroki)) === false) {
		$igroki[] = "<b>{$row['kapitan']}</b>";
	} else {
		$igroki[$pos] = "<b>{$row['kapitan']}</b>";
	}
	usort($igroki, function ($a, $b) { $aparts = explode(' ', $a); $bparts = explode(' ', $b); return strcmp($aparts[count($aparts)-1], $bparts[count($bparts)-1]); });
	include 'chgk.php';
	$count++;
	if($count %2 == 0) {
		echo "</tr><tr>";
	}
}

echo "<table class=\"allteams\"><tr>";

$fp = fopen($argv[1], "r");
while($row = get_row($fp)) {
	process($row);
}

echo "</tr></table>";
echo "Всего зарегистрированы $count команд.<br>";
echo "<a name=\"zach\"></a><sup>*</sup> Команда играет вне отборочного зачёта ЧМ<br>";
