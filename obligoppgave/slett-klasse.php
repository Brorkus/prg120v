<style>
  .melding {
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    font-weight: bold;
    width: fit-content;
  }
  .feil {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }
  .suksess {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }
</style>
<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

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
          echo "<div class='melding feil'>Klasse m&aring; velges</div>";
        }
      else
      {
          include("dbconnect.php");  /* tilkobling til database */
          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* Klassekode er ikke i bruk */
            {
              echo "<div class='melding feil'>Klassekode er ikke i bruk</div>";
            }
      
          else
        {
          
          $sqlSetning="SELECT * FROM student WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Klasse har studenter */
            {
              echo "<div class='melding feil'>Kan ikke slette klasse med studenter</div>";
            }
          else
            {
              $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
              mysqli_query($db,$sqlSetning) or die ("kunne ikke slette data i databasen");
                /* SQL-setning sendt til database */
		
              echo "<div class='melding suksess'>Klasse med klassekode: $klassekode har blitt slettet</div>";
            }
        }
    }
}
?>