<?php

$url = "https://news.ycombinator.com/";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
curl_close($ch);

libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML($html);

$links = $dom->getElementsByTagName("a");

$file = fopen("output.csv", "w");
fputcsv($file, ["texto", "link"]);

foreach ($links as $link) {
    $texto = trim($link->textContent);
    $href = $link->getAttribute("href");

    if ($texto && $href) {
        fputcsv($file, [$texto, $href]);
    }
}

fclose($file);

echo "ok\n";
