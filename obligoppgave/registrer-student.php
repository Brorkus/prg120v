<?php
?>
<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerKlasse" name="registrerKlasse">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Klassekode <select name="klassekode" id="klassekode">
    <option value="">velg klassekode</option>
    <?php include("funksjoner.php"); listeboksKlassekode(); ?> 
  </select>  <br/>
  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

  
  


<?php
 if (isset($_POST ["registrerStudentKnapp"]))
    {
      $brukernavn=$_POST ["brukernavn"];
      $fornavn=$_POST ["fornavn"];
      $etternavn=$_POST ["etternavn"];
      $klassekode=$_POST ["klassekode"];

      if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode)
        {
          print ("B&aring;de brukernavn, forenavn, etternavn og klassekode m&aring; fylles ut");
        }
      else
        {
          include("dbconnect.php");  /* tilkobling til database */

          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Brukernavn er registrert fra før */
            {
              print ("$brukernavn er allerede i bruk");
            }
          else
            {
              $sqlSetning="INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
              mysqli_query($db,$sqlSetning) or die ("Kunne ikke registrere data i database");
                /* SQL-setning sendt til database */

              print ("Denne studenten er blitt registrert: $brukernavn, $fornavn $etternavn, $klassekode"); 
            }
        }
    }
    ?>