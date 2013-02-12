<?php
$pages = array(
	"index" => "Домой", 
	"Чемпионат" => 
		array(
			"news" => "Новости",
			"anons" => "Приглашение",
			"living" => "Размещение",
			"directions" => "Транспорт",
			"schedule" => "Расписание",
//			"anons" => "Отзывы",
			"contacts" => "Контакты",
		),
	"ЧГК" => 
		array(
			"chgk_regl" => "Регламент",
			"chgk_par" => "Участники",
			"results" => "Результаты",
			"voprosy" => "Вопросы",
		),
);

/////////////////
if(empty($_GET['page'])) {
	$current = 'index';
} else {
	$current = pathinfo($_GET['page'], PATHINFO_FILENAME);
}

foreach($pages as $page => $name) {
	if(is_array($name)) {
		$flat_index = array_merge($flat_index, $name);
	} else {
		$flat_index[$page] = $name;
	}
}

if($current == 'index') {
	$title = 'Чемпионат по ЧГК 2013';
} else if(!empty($flat_index[$current])) {
	$title = $flat_index[$current];
} 
if(empty($title) || !file_exists("$current.html")) {
	$title = 'Страница не найдена';
	$current = '404';
	header("HTTP/1.0 404 Not Found");
}

function print_link($name, $page)
{
	if($GLOBALS['current'] == $page) {
		return "<span class=\"current\">$name</span><br>\n";		
	} else {
		return "<a href=\"$page\">$name</a><br>\n";
	}
}

function navigation() {
	foreach($GLOBALS['pages'] as $page => $name) {
		if(is_array($name)) {
			echo "<span class=\"pages\">$page</span><br>\n";
				foreach($name as $subpage => $name) {
					echo "&nbsp;&nbsp;".print_link($name, $subpage);
				}
		} else {
			echo print_link($name, $page);
		}
	}
}

function content() {
	global $current;
	echo file_get_contents("$current.html");
}
