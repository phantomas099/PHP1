<?php
session_start();
error_reporting( ~E_NOTICE ); 

require_once 'dbconfig.php';


?>

<?php
if (isset($_REQUEST["do"])) {

    include ("include/" . $_REQUEST["do"] . ".php");
} else {
    include ("content.php");
}

?>