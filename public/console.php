<?php

if ( isset($_GET['console']) )
{
    $file = realpath(dirname(__FILE__) . '/../data/scripts/load.sqlite.php');
    $args = explode(' ', $_GET['console']);
    $argv = array( 0 => $file);
    for ( $i = 0; $i < count($args); $i++ )
    {
        $argv[$i+1] = $args[$i];
    }
    $_SERVER['argv'] = $argv;
    
    /*
    echo 'Server:<br />'."\n";
    echo '<pre>';
    print_r($_SERVER);
    echo '</pre>';
    echo 'File:<br />'."\n";
    echo $file;
    echo file_exists($file) ? ' exists' : ' not found';
    */
    ob_start();
    require $file;
    $data = ob_get_contents();
    ob_end_clean();
    echo nl2br($data);
    echo '<br><br>';
    echo '<a href="'.$_SERVER['PHP_SELF'].'">Back to form</a>';
}
else
{
    ?>
<html>
<head>
	<title>load.sqlite.php via web interface</title>
</head>
<body>
	<h1>load.sqlite.php via web interface</h1>
	<form method="get">
		<label for="console">Command Line Arguments:</label>
		<br />
		<textarea id="console" name="console" cols="40" rows="3"></textarea>
		<br />
		<input type="submit" name="submit" value="submit" />
	</form>
</body>
</html>        
    <?php 
}
?>