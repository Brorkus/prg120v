<?php
?>
<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerKlasse" name="registrerKlasse">
  Klassekode <input type="text" id="klassekode" name="klassekode" required /> <br/>
  Klassenavn <input type="text" id="klassenavn" name="klassenavn" required /> <br/>
  Studiumkode <input type="text" id="studiumkode" name="studiumkode" required /> <br/>
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
          print ("B&aring;de klassekode, klassenavn og studiumkode m&aring; fylles ut");
        }
      else
        {
          include("dbconnect.php");  /* tilkobling til database */

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Klasse er registrert fra før */
            {
              print ("$klassekode er allerede i bruk");
            }
          else
            {
              $sqlSetning="INSERT INTO klasse VALUES('$klassekode','$klassenavn','$studiumkode');";
              mysqli_query($db,$sqlSetning) or die ("Kunne ikke registrere data i database");
                /* SQL-setning sendt til database */

              print ("Denne klassen er blitt registrert: $klassekode, $klassenavn, $studiumkode"); 
            }
        }
    }
    ?>