<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Disk Tests</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    	var_dump($_POST);
    }
    ?>
  </head>
  <body>
  	<center>
  	<div class="row">
	    <p><h1>Disk performance</h1></p>

	    <div class="col-md-4 col-md-offset-4">
	    <form class="form-horizontal" action="">
		  <div class="form-group">
		    <label for="inputTarget" class="col-sm-2 control-label">Target</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputTarget" placeholder="/tmp">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputSize" class="col-sm-2 control-label">Size</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputSize" placeholder="Size in MegaOctets (only for Read Test)">
		    </div>
		  </div>
		  <div class="form-group">
		  <label for="inputSize" class="col-sm-2 control-label">Type</label>
		    <div class="col-sm-10">
			  <select id="inputType" class="form-control">
				  <option>Read</option>
				  <option>Write</option>
				  <option>Read/Write</option>
			  </select>
			</div>
		  </div>
		  </form>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick='tests()'  class="btn btn-primary">Launch tests</button>
		    </div>
		  </div>
		
		</div>

	    <div class="col-md-4 top-buffer col-md-offset-4" id="tests"></div>

	    <div class="col-md-4 col-md-offset-4" id="history">
	    <h2>History</h2>
	    <table class="table table-striped table-condensed table-bordered">
	    	<th>Date</th><th>Target</th><th>Type</th><th>Size</th><th>Speed</th>
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
			    			echo "<td>$infos[3]</td>";
		    				echo "</tr>";
		    			}
	    			}
	    		}
	    	}
	    	?>
		</table>


		</div>
	</div>
    </center>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>
  </body>
</html>




