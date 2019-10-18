<?
include('./lib/simple_html_dom.php');

@$articules = file_get_contents('./Артикулы.txt') or die('Либо файл не найден, либо артикулы отсутсвуют');
$results = fopen("./Результат.txt", 'a');

$sku = explode(PHP_EOL, $articules);

foreach($sku as $articule)
{
    @$html = file_get_html("https://www.komus.ru/product/$articule/");
    if (empty($html))
    {
        fwrite($results, $articule . " null" . PHP_EOL);
    }
    else
    {
        $res = $html->find('span[class=i-fs30 i-fwb]');
        $res = strip_tags($res[0]);
		$res = trim($res);

        if (empty($res))
        {
            $res = $html->find('span[class=i-td-thr i-fs22 i-fwb]');
            $res = strip_tags($res[0]);
            $res = trim($res);
        }

        if (empty($res))
        {
        	$res = "null";
        }
        
        fwrite($results, $articule . " " . $res . PHP_EOL);
    }
}

echo "Зайдите в ваш файл";