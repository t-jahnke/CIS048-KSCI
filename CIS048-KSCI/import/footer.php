    
<?php
if (isset($_GET['debug']))
{
    echo ("<pre>");
    var_dump($_SESSION);
    echo ("</pre>");
}
?>