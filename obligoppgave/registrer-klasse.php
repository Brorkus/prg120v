<style>
  background: rgba(72, 71, 70);
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
<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerKlasse" name="registrerKlasse">
  Klassekode <input type="text" id="klassekode" name="klassekode" maxlength="5" required /> Maks 5 tegn <br/>
  Klassenavn <input type="text" id="klassenavn" name="klassenavn" maxlength="50" required /> Maks 50 tegn <br/>
  Studiumkode <input type="text" id="studiumkode" name="studiumkode" maxlength="50" required /> Maks 50 tegn <br/>
  <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php
 if (isset($_POST ["registrerKlasseKnapp"]))
    {
      $klassekode=$_POST ["klassekode"];
      $klassenavn=$_POST ["klassenavn"];
      $studiumkode=$_POST ["studiumkode"];

      if (!$klassekode || !$klassenavn || !$studiumkode)
        {
          echo "<div class='melding feil'>B&aring;de klassekode, klassenavn og studiumkode m&aring; fylles ut</div>";
        }
      else if (strlen($klassekode)>5 || strlen($klassenavn)>50 || strlen($studiumkode)>50)
        {
          echo "<div class='melding feil'>En eller flere felt er for lange</div>";
        }
      else
        {
          include("dbconnect.php");  /* tilkobling til database */

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Klasse er registrert fra før */
            {
              echo "<div class='melding feil'>$klassekode er allerede i bruk</div>";
            }
          else
            {
              $sqlSetning="INSERT INTO klasse VALUES('$klassekode','$klassenavn','$studiumkode');";
              mysqli_query($db,$sqlSetning) or die ("Kunne ikke registrere data i database");
                /* SQL-setning sendt til database */

              echo "<div class='melding suksess'>Denne klassen er blitt registrert: $klassekode, $klassenavn, $studiumkode</div>";
            }
        }
    }
    ?>