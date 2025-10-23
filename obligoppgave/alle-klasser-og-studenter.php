<?php
include("dbconnect.php"); /* tilkobling til database */

$sqlSetning= "select * from klasse;";

$sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");

$antallRader=mysqli_num_rows($sqlResultat); /*antall rader beregnet*/ 

 print ("<h3>Registrerte klasser</h3>");
  print ("<table border=1>");   /*tabell start */
  print ("<tr><th align=left>Klassekode</th> 
          <th align=left>Klassenavn</th>
          <th align=left>Studiumkode</th></tr>"); 
  
  for ($r=1;$r<=$antallRader;$r++)
  {
    $rad=mysqli_fetch_array($sqlResultat);
    $klassekode=$rad["klassekode"];
    $klassenavn=$rad["klassenavn"];
    $studiumkode=$rad["studiumkode"];

    print("<tr> <td> $klassekode </td> <td> $klassenavn </td> <td> $studiumkode </td> </tr>");
  }
  print("</table>"); /*tabell slutt */


  $sqlSetning= "select * from student;";

$sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");

$antallRader=mysqli_num_rows($sqlResultat); /*antall rader beregnet*/ 

 print ("<h3>Registrerte studenter</h3>");
  print ("<table border=1>");   /*tabell start */
  print ("<tr><th align=left>Brukernavn</th> 
          <th align=left>Fornavn</th>
          <th align=left>Etternavn</th>
          <th align=left>Klassekode</th></tr>"); 
  
  for ($r=1;$r<=$antallRader;$r++)
  {
    $rad=mysqli_fetch_array($sqlResultat);
    $brukernavn=$rad["brukernavn"];
    $fornavn=$rad["fornavn"];
    $etternavn=$rad["etternavn"];
    $klassekode=$rad["klassekode"];

    print("<tr> <td> $brukernavn </td> <td> $brukernavn </td> <td> $etternavn </td> <td> $klassekode </td> </tr>");
  }
  print("</table>"); /*tabell slutt */
  ?>