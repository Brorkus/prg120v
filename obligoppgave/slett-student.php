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

<h3>Slett student</h3>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onSubmit="return bekreft()">
    Slett student <select name="slettstudent" id="slettstudent">
        <option value="">velg student</option>
        <?php include("funksjoner.php"); listeboksBrukernavn(); ?> 
        </select>  <br/>
  <input type="submit" value="Slett student" id="slettStudentKnapp" name="slettStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
 if (isset($_POST ["slettStudentKnapp"]))
    {	
      $brukernavn=$_POST ["slettstudent"];
	  
	  if (!$brukernavn)
        {
          echo "<div class='melding feil'>Student m&aring; velges</div>";
        }
      else
        {
          include("dbconnect.php");  /* tilkobling til database */
          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* Brukernavn er ikke i bruk */
            {
              echo "<div class='melding feil'>Brukernavn er ikke i bruk</div>";
            }
          else
            {	  
              $sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
              mysqli_query($db,$sqlSetning) or die ("kunne ikke slette data i databasen");
                /* SQL-setning sendt til database */
		
              echo "<div class='melding feil'>Student med brukernavn: $brukernavn har blitt slettet</div>";
            }
        }
    }
?>