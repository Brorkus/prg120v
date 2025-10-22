<?php
?>
<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerKlasse" name="registrerKlasse">
  Klassekode <input type="text" id="klasseKode" name="klasseKode" required /> <br/>
  Klassenavn <input type="text" id="klasseNavn" name="klasseNavn" required /> <br/>
  Studiumkode <input type="text" id="studiumKode" name="studiumKode" required /> <br/>
  <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>
<?php
 if (isset($_POST ["registrerKlasseKnapp"]))
    {
      $klasseKode=$_POST ["klasseKode"];
      $klasseNavn=$_POST ["klasseNavn"];
      $studiumKode=$_POST ["studiumKode"];

      if (!$klasseKode || !$klasseNavn || !$studiumKode)
        {
          print ("B&aring;de klassekode, klassenavn og studiumkode m&aring; fylles ut");
        }
      else
        {
          include("dbconnect.php");  /* tilkobling til database */

          $sqlSetning="SELECT * FROM klasse WHERE klassekode='$klasseKode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra database");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* Klasse er registrert fra før */
            {
              print ("Klasse er allerede registrert");
            }
          else
            {
              $sqlSetning="INSERT INTO klasse VALUES('$klasseKode','$klassenavn','$studiumKode);";
              mysqli_query($db,$sqlSetning) or die ("Kunne ikke registrere data i database");
                /* SQL-setning sendt til database */

              print ("Denne klassen er blitt registrert: $klasseKode $klasseNavn $studiumKode"); 
            }
        }
    }
    ?>