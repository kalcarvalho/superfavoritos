<?php

ini_set('display_errors', true);
ini_set('max_execution_time', 0);
error_reporting(E_ALL);

//$termo = utf8_decode("passaporte%20temporário");
$termo = $_REQUEST['s'];
$termo = preg_replace('/\s+/', '%20', $termo);
$max = 100;
//$termo = mb_convert_encoding($termo, 'HTML-ENTITIES', "UTF-8");

$html = file_get_contents("http://www.google.com.br/search?q=$termo&num=$max&ie=UTF-8", FILE_TEXT);

$dom = new DOMDocument;
@$dom->loadHTML($html); // change loadHTML to loadHTMLFile, and replace $html with the real url encased in quotes
$xpath = new DOMXPath($dom);
$aTag = $xpath->query('//h3[@class="r"]/a');

$i = 0;

header('Cache-Control: no-cache');
header('Content-type: text/html; charset="utf-8"', true);

$termo = str_replace("%20", " ", $termo);
echo "<p>Pesquisando por <strong>$termo</strong></p>";

foreach ($aTag as $val) {
	$href = $val->getAttribute('href');
	$url = str_replace("/url?q=", "", $href);


	$arr[] = preg_replace('/(&sa=).*/', '', $url);

	$pos = strpos($url, "www.omelhordeviajar.com.br");
	$i++;
	if ($pos !== false) {
		$p = intval(($i - 1) / 10) + 1;
		echo "Página $p / posição $i.";
		echo '<pre>' . print_r($arr, true);
		exit;
	}
}


echo "Não encontrado";
echo '<pre>' . print_r($arr, true);




/*
		if(preg_match_all('/<a\s+href=["\']([^"\']+)["\']/i', $url, $links, PREG_PATTERN_ORDER)) {

		$hrefs = array_unique($links[1]);

		var_dump($hrefs);
	}
	*/

function DOMinnerHTML(DOMNode $element) {

	$innerHTML = "";
	$children  = $element->childNodes;

	foreach ($children as $child) {
		$innerHTML .= $element->ownerDocument->saveHTML($child);
	}

	return $innerHTML;
}
