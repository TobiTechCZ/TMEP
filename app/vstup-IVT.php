<?php
//CRON kazdych 15 minut

////////////////////////////////////////////////////////////////////////
// VLOZENI SOUBORU
////////////////////////////////////////////////////////////////////////

require "./config.php";         // skript s nastavenim
require "./scripts/db.php";     // skript s databazi


////////////////////////////////////////////////////////////////////////
// Zpracovani hodnoty a jeji ulozeni
////////////////////////////////////////////////////////////////////////
MySQLi_query($GLOBALS["DBC"], "insert INTO ".$dbTableprefix."tme
(
SELECT null,datum,hodnota,null FROM ".$dbTableprefix."cidla where cidlo like 'Outdoor' and datum > NOW() - INTERVAL 5 MINUTE GROUP BY
CONCAT(
    DATE_FORMAT(`datum`,'%m-%d-%Y %H:'),
    FLOOR(DATE_FORMAT(`datum`,'%i')/5)
)
);");

