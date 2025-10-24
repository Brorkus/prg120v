<?php
?>
<script src="funksjoner.js"> </script>

<h3>Slett klasse<h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
Slett klasse <select name="slettklasse" id="slettklasse">
    <option value="">velg klasse</option>
    <?php include("funksjoner.php"); listeboksKlasse(); ?> 
  </select>  <br/>
  <input type="submit" value="Slett klasse" id="slettKlasseKnapp" name="slettKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>
<?php
 if (isset($_POST ["slettKlasseKnapp"]))
    {	
      $klassekode=$_POST ["slettklasse"];
	  
	  if (!$klassekode)
        {
          print ("Klasse m&aring; velges");
        }
      else
        {
          include("dbconnect.php");  /* tilkobling til database */
          $sqlSetning="SELECT * FROM student WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* poststedet er ikke registrert */
            {
              print ("Kan ikke slette klasse med studenter");
            }
          else
            include("dbconnect.php");  /* tilkobling til database */
          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 
            {	  
              $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
              mysqli_query($db,$sqlSetning) or die ("kunne ikke slette data i databasen");
                /* SQL-setning sendt til database */
		
              print ("Klasse med klassekode: $klassekode har blitt slettet <br />");
            }
        }
    }
?>