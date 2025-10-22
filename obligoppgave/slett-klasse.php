<?php
?>
<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klassekode <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
 if (isset($_POST ["slettKlasseKnapp"]))
    {	
      $klassekode=$_POST ["klassekode"];
	  
	  if (!$klassekode)
        {
          print ("Klassekode m&aring; fylles ut");
        }
      else
        {
          include("dbconnect.php");  /* tilkobling til database */
          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* poststedet er ikke registrert */
            {
              print ("Klassekode er ikke i bruk");
            }
          else
            {	  
              $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
              mysqli_query($db,$sqlSetning) or die ("kunne ikke slette data i databasen");
                /* SQL-setning sendt til database */
		
              print ("Klassen med klassekode $klassekode har blitt slettet <br />");
            }
        }
    }
?>