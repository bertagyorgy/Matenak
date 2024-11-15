<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menü</title>
</head>
<style>
    body{
        margin: 0;
        font-family: Arial;
        font-size: 20px;
    }
    div#menu{
        background-color: lightgrey;
        text-align: center;
    }
    div#menu a{
        width: 120px;
        display: inline-block;
        text-decoration: none;
        color: #666;
        text-align: center;
    }
    div#menu a:hover{
        color: #000;
        background-color: #ddd;
    }
    div#tartalom{
        margin-left: 200px;
        min-height: 480px;
    }
    div#lablec{
        background-color: #000;
        color: #fff;
    }
</style>
<body>
    <div id='menu'>
        [
        <a href='./'>Kezdőlap</a>            |
        <a href='./?p=termekek'>Termékek</a> |
        <a href='./?p=help'>Segítség</a>     |
        <a href='./?p=gyik'>GY.I.K</a>       |
        <a href='./?p=rolunk'>Rólunk</a>
        ]
    </div>
    <div id='tartalom'>

<?php
    if( isset($_GET['p']) ) $p = $_GET['p'];
    else                   $p = ""         ;

    if( $p==""        ) print "<h2> Akciók </h2>"                    ; else
    if( $p=="termekek") print "<h2> Termékek, szolgáltatások </h2>"  ; else
    if( $p=="help"    ) print "<h2> Terméktámogatás</h2>"            ; else
    if( $p=="gyik"    ) include("gyik.php")                          ; else
    if( $p=="rolunk"  ) include("rolunk.php")                        ; else
                        include("404.php")                           ;

?>

    </div>
    <div id="lablec">
        &copy; enoldalam.hu - 2024.
<?php
    $fajlnev = "szamlalo.txt";
    if(!file_exists($fajlnev))
    {
        $fp = fopen($fajlnev, "w");
        fwrite($fp, "0");
        fclose($fp);
    }
    $fp = fopen($fajlnev, "r");
    $n = fread($fp, filesize($fajlnev));
    fclose($fp);
    
    if(!isset($_SESSION['ittjártam']))
    {
        $n++;
        $_SESSION['ittjártam'] = 1;
        $fp = fopen($fajlnev, "w");
        fwrite($fp, $n);
        fclose($fp);
    }
    print" - Te vagy a(z) $n. látogató"
?>
        <div style='float:right;'>
<?php
    
    $honapok = array( "", "Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December");
    $napok = array( "", "Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat", "Vasárnap");
    //include("nevnapok.php");
    print date("Y. ") . $honapok[date("n")]  . date(" d. ") . $napok[date("N")];
?>
        </div>
    </div>
    
</body>
</html>
