
<?php
include ("tools.php");
$size=$_GET['size'];
$target=$_GET['target'];
$type=$_GET['type'];

$date = date("Y-m-d_H:i:s");  
$file = fopen("log/$date.log", "a+");


if ($type == "Read") {
	echo '<div class="panel panel-default">';
	echo '<div class="panel-heading"><h4>'.$type.' Results</h4></div>';
	echo '<div class="panel-body">';
	$results = testRead($target, $size);
	echo '<dl class="well dl-horizontal">';
	echo '<dt>Target</dt>';
	echo '<dd>'.$results['target'].'</dd>';
	echo '<dt>Size</dt>';
	echo '<dd>'.$results['size'].'</dd>';
	echo '<dt>Speed</dt>';
	echo '<dd>'.$results['speed'].'</dd>';
	echo "</dl>";
	echo '</div>';
	echo '</div>';
	fwrite($file, $results['target'].";".$type.";".$results['size'].";".$results['speed']."\n");
}

if ($type == "Write") {
	echo '<div class="panel panel-default">';
	echo '<div class="panel-heading"><h4>'.$type.' Results</h4></div>';
	echo '<div class="panel-body">';
	$results = testWrite($target, $size);
	echo '<dl class="well dl-horizontal">';
	echo '<dt>Target</dt>';
	echo '<dd>'.$target.'</dd>';
	echo '<dt>Size</dt>';
	echo '<dd>'.$results['size'].'</dd>';
	echo '<dt>Speed</dt>';
	echo '<dd>'.$results['speed'].'</dd>';
	echo "</dl>";
	echo '</div>';
	echo '</div>';
	fwrite($file, $target.";".$type.";".$results['size'].";".$results['speed']."\n");
	fclose($file);
}

if ($type == "Read/Write") {
	echo '<div class="panel panel-default">';
	echo '<div class="panel-heading"><h4>Write Results</h4></div>';
	echo '<div class="panel-body">';
	$results = testWrite($target, $size);
	echo '<dl class="well dl-horizontal">';
	echo '<dt>Target</dt>';
	echo '<dd>'.$target.'</dd>';
	echo '<dt>Size</dt>';
	echo '<dd>'.$results['size'].'</dd>';
	echo '<dt>Speed</dt>';
	echo '<dd>'.$results['speed'].'</dd>';
	echo "</dl>";
	echo '</div>';
	echo '</div>';
	fwrite($file, $target.";".$type.";".$results['size'].";".$results['speed']."\n");
	
	echo '<div class="panel panel-default">';
	echo '<div class="panel-heading"><h4>Read Results</h4></div>';
	echo '<div class="panel-body">';
	$results = testRead($target, $size);
	echo '<dl class="well dl-horizontal">';
	echo '<dt>Target</dt>';
	echo '<dd>'.$results['target'].'</dd>';
	echo '<dt>Size</dt>';
	echo '<dd>'.$results['size'].'</dd>';
	echo '<dt>Speed</dt>';
	echo '<dd>'.$results['speed'].'</dd>';
	echo "</dl>";
	echo '</div>';
	echo '</div>';
	fwrite($file, $results['target'].";".$type.";".$results['size'].";".$results['speed']."\n");
}

fclose($file);
?>
