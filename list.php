<h3>Список всех доступных тестов</h3>

<?php

$searchdir = __DIR__ . '/tests/';
$files = array_diff(scandir($searchdir), array('..', '.'));

echo '<ul>';
foreach ($files as $file) {
    echo '<li><a href="http://' . $_SERVER['HTTP_HOST']. '/test.php?name='.basename($file, '.json').'">' . $file . '</a></li>';
}
echo '</ul>';

?>
