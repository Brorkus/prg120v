<?php
include("dbconnect.php");

$sqlSetning= "select * from klasse;";

$sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");

$antallRader=mysqli_num_rows($sqlResultat); /*antall rader beregnet*/ 

 print ("<h3>Registrerte klasser</h3>");
  print ("<table border=1>");   /*tabell start */
  print ("<tr><th align=left>klassekode</th> 
          <th align=left>klassenavn</th>
          <th align=left>studiumkode</th></tr>"); 
  
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
  print ("<tr><th align=left>brukernavn</th> 
          <th align=left>fornavn</th>
          <th align=left>etternavn</th>
          <th align=left>klassekode</th></tr>"); 
  
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