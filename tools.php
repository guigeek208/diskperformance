<?php

function bonnie($target, $size) {
	$return = shell_exec("/usr/sbin/bonnie++ -r $size -d $target > /tmp/bonnie.log");
	$return = shell_exec("tail -1 /tmp/bonnie.log | bon_csv2html");
	//echo $return;
	if (preg_match("/(<table[\s\S]*<\/table>)/i", $return, $matches)) {
		$result = $matches[1];
	}

	$tmp = str_replace("<table", "<table class='table table-striped'", $result);
	return $tmp;
}

function testWrite($target, $size) {
	$results = array();
	$return = shell_exec("dd if=/dev/zero of=$target/speedtest bs=1M count=$size conv=fdatasync > /tmp/dd.log 2>&1");
	$return = shell_exec("tail -1 /tmp/dd.log && rm /tmp/dd.log");
	//echo $return;
	if (preg_match("/.*\((.*)\).*,.*,(.*)/i", $return, $matches)) {
		//echo "OK<br>";
		$results['size'] = $matches[1];
		$results['speed'] = $matches[2];
	}
	return $results;
}

function testRead($target, $size) {
	$results = array();
	$return = shell_exec('df -m | grep "/tmp" | cut -d" " -f1');
	if ($return == "") {
		$return = shell_exec('df -m | grep "/$" | cut -d" " -f1');
	}
	$infos = explode("\n", $return);
	$dev = $infos[0];
	$return = shell_exec("sudo hdparm -t $dev");
	if (preg_match("/Timing buffered disk reads:\s+(\d+\s+\w+).*=\s+(.*)$/i", $return, $matches)) {
		$results['size'] = $matches[1];
		$results['speed'] = $matches[2];
		$results['target'] = $dev;
	}
	return $results;
}

?>