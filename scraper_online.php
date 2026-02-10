<?php

$html = '
<html>
  <body>
    <a href="https://site1.com">Link 1</a>
    <a href="https://site2.com">Link 2</a>
    <a href="https://site3.com">Link 3</a>
  </body>
</html>
';

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
