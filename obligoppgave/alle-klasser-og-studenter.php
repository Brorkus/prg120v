<?php
include("dpconnect.php");

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
    $rad=mysqli_fech_array($sqlResultat);
    $klasseKode=$rad["klassekode"];
    $klasseNavn=$rad["klassenavn"];
    $studiumKode=$rad["studiumkode"];

    print("<tr> <td> $klasseKode </td> <td> $klasseNavn </td> <td> $studiumKode </td> </tr>");
  }
  print("</table>"); /*tabell slutt */
  ?>