<h2>History</h2>
<table class="table table-striped table-condensed table-bordered">
	<th>Date</th><th>Type</th><th>Size</th><th>Speed</th>
	<?php
	$dir = 'log';
	$files = scandir($dir, 1);
	//print_r($files);
	foreach ($files as $file) {
		if (preg_match('/(\d{4}-\d{2}-\d{2}_\d{2}:\d{2}:\d{2}).log/', $file, $matches)) { 
			
			$data = file_get_contents("log/$file");
			$lines = explode("\n", $data);
			foreach ($lines as $line) {
				if ($line != "") {
    				$infos = explode (';', $line);
    				echo "<tr>";
    				echo "<td>".$matches[1]."</td>";
    				echo "<td>$infos[0]</td>";
	    			echo "<td>$infos[1]</td>";
	    			echo "<td>$infos[2]</td>";
    				echo "</tr>";
    			}
			}
		}
	}
	?>
</table>