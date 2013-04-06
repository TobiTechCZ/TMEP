<?php

  // Hlavicka
  require "head.php";
    
  echo "<h3>{$lang['pocetmereni']} ({$lang['min2']}/{$lang['max2']})</h3>";

  ////////////////////////////////////////////
  // NEJNIZSI
  // Tabulka s hodnotami + krmeni dat pro graf
  $tabulka = "<table width='600'><tr><td width='300'>
              <table width='260' class='tabulkaVHlavicce'>
              <tr class='radek'><td colspan='2'>&nbsp;<b>{$lang['nejmenemereni']}</b></td></tr>
              <tr class='radek'>
                <td>&nbsp;<b>{$lang['den']}</b></td>
                <td>&nbsp;<b>{$lang['pocetmereni']}</b></td>";
    $tabulka .= "</tr>";

    // Nacteme dny a teploty
    $q = MySQL_query("SELECT den, mereni 
                      FROM tme_denni 
                      WHERE mereni IS NOT null
                      ORDER BY mereni ASC 
                      LIMIT 50");

    while($r = MySQL_fetch_assoc($q))
    {

      // zelene = vikend
      $vikend = jeVikend($r['den']);

      // Radek tabulky
      $tabulka .= "<tr class='radekStatModal'>
              <td align='center'><b>".($vikend == 1 ? "<font style='color: #009000;'>" : "").formatDnu($r['den']).($vikend == 1 ? "</font>" : "")."</b></td>
              <td align='center'>{$r['mereni']}</td>";
            $tabulka .=  "</tr>";

    }

    $tabulka .=  "</table>";
    
  ////////////////////////////////////////////
  // Nejvyssi
  // Tabulka s hodnotami + krmeni dat pro graf
  $tabulka .= "</td><td width='300'>
              <table width='260' class='tabulkaVHlavicce'>
              <tr class='radek'><td colspan='2'>&nbsp;<b>{$lang['nejvicemereni']}</b></td></tr>
              <tr class='radek'>
                <td>&nbsp;<b>{$lang['den']}</b></td>
                <td>&nbsp;<b>{$lang['pocetmereni']}</b></td>";
    $tabulka .= "</tr>";

    // Nacteme dny a teploty
    $q = MySQL_query("SELECT den, mereni 
                      FROM tme_denni 
                      WHERE mereni IS NOT null
                      ORDER BY mereni DESC 
                      LIMIT 50");
    while($r = MySQL_fetch_assoc($q))
    {

      // zelene = vikend
      $vikend = jeVikend($r['den']);

      // Radek tabulky
      $tabulka .= "<tr class='radekStatModal'>
              <td align='center'><b>".($vikend == 1 ? "<font style='color: #009000;'>" : "").formatDnu($r['den']).($vikend == 1 ? "</font>" : "")."</b></td>
              <td align='center'>{$r['mereni']}</td>";
            $tabulka .=  "</tr>";

    }

  $tabulka .=  "</table>";
   
  $tabulka .= "</td></tr></table>";

  // Tabulka s hodnotami
  echo $tabulka;

  // Paticka
  require "foot.php";

?>