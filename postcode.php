<?php
if(isset($_GET['postal_code'])) {
  $postal_code = $_GET['postal_code'];
  $url = "https://polish-zip-codes1.p.rapidapi.com/$postal_code";

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
       "Accept: application/json",
      "X-RapidAPI-Host: polish-zip-codes1.p.rapidapi.com",
      "X-RapidAPI-Key: 9de3c106ecmshc2d4b8629f67d15p101489jsn07e1b5d6af9b"
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  
  if ($err) {
    echo "Błąd pobierania danych: " . $err;
  } else {
    $result = json_decode($response, true);


    if (count($result) > 0) { ?>

 <select name="category" id="categoryAnn">

<?php
    for ($x=1; $x<count($result); $x++) {
    ?>

      <option value="<?php echo $result[$x]['miejscowosc']; ?>"><?php  echo $result[$x]['miejscowosc']; ?></option>

      <?php
    }
?>
  </select>

  <?php
      
    } else {
      echo "Nie znaleziono takiego kodu pocztowego.";
    }
  }
}
?>

