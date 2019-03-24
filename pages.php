<?php
$pages = array(
	"Чемпионат" =>
		array(
			"news" => "Новости",
			"anons" => "Приглашение",
			"living" => "Размещение",
			"schedule" => "Расписание",
			"contacts" => "Контакты",
//			"memoirs" => "Отчёты",
//			"memory" => "Мемориальная страница",
	),
	"ЧГК" =>
		array(
			"chgk_regl" => "Регламент",
			"chgk_reg" => "Регистрация",
			"leg" => "Легионеры",
			"chgk_par" => "Участники",
			"jury" => "ИЖ и АЖ",
			"results" => "Результаты",
//			"voprosy" => "Вопросы",
		),
	"Брейн-Ринг" =>
		array(
			"br_regl" => "Регламент",
			"br_par" => "Участники",
//			"br_res" => "Результаты",
		),
	"Своя Игра" =>
		array(
			"si_regl" => "Регламент",
			"si_reg" => "Регистрация",
			"si_par" => "Участники",
//			"si_results" => "Результаты",
		),
);
$subpages = array(
		'badreg_empty' => 'Ошибка регистрации!',
		'badreg_robot' => 'Ошибка регистрации!',
		'goodreg' => 'Регистрация принята',
);

$redirects = array(
	'apel' => 'https://docs.google.com/forms/d/e/1FAIpQLSd3SjEzNzAQWdz-Inwv0ZiNXR4miAFYZUBiMTt9PxBMLmbkMw/viewform',
);

/////////////////
if(empty($_GET['page'])) {
	$current = 'news';
} else {
	$current = pathinfo($_GET['page'], PATHINFO_FILENAME);
}

if (isset($redirects[$current])) {
	header("Location: {$redirects[$current]}");
	exit();
}

$flat_index = $subpages;
foreach($pages as $page => $name) {
	if(is_array($name)) {
		$flat_index = array_merge($flat_index, $name);
	} else {
		$flat_index[$page] = $name;
	}
}


if($current == 'index') {
	$title = 'Чемпионат по ЧГК 2019';
} else if($current == 'living') {
	$title = "Куда, блин? To Dublin!";
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
			echo "<div class=\"pages\">$page</div>\n";
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
