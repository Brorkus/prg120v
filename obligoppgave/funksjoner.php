<?php
function listeboksKlassekode()
{
  include("dbconnect.php");  /* tilkobling til database */
      
  $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database"); 
    /* SQL-setning sendt til database */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader beregnet */

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra resultatet */
      $klassekode=$rad["klassekode"];
      $klassenavn=$rad["klassenavn"];
      $studiumkode=$rad["studiumkode"];

      print("<option value='$klassekode'>$klassekode, $klassenavn, $studiumkode </option>");  /* ny verdi i listeboksen laget */
    }
}
?>