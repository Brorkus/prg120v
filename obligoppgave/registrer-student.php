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
<h3>Registrer student </h3>

<form method="post" action="" id="registrerKlasse" name="registrerKlasse">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" maxlength="7" required /> Max 7 tegn <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" maxlength="50" required /> Max 50 tegn<br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" maxlength="50" required /> Max 50 tegn<br/>
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
          echo "<div class='melding feil'>B&aring;de brukernavn, forenavn, etternavn og klassekode m&aring; fylles ut</div>";
        }
         else if (strlen($brukernavn)>7 || strlen($fornavn)>50 || strlen($etternavn)>50 || strlen($klassekode)>5)
        {
          echo "<div class='melding feil'>En eller flere felt er for lange</div>";
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
          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Brukernavn er registrert fra før */
            {
              echo "<div class='melding feil'>$brukernavn er allerede i bruk</div>";
            }
          else
            {
              $sqlSetning="INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
              mysqli_query($db,$sqlSetning) or die ("Kunne ikke registrere data i database");
                /* SQL-setning sendt til database */

              echo "<div class='melding suksess'>Denne studenten er blitt registrert: Brukernavn: $brukernavn, Navn: $fornavn $etternavn, Klasse: $klassekode</div>";
            }
            }
        }
    }
    ?>