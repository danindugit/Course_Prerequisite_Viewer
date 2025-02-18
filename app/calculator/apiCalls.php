<?php
if (isset($_POST['action'])) {
   $action = $_POST['action'];
   if ($action === 'callGetUltimatePrereqs') {
      $param = $_POST['param'];
      $result = callGetUltimatePrereqs($param);
      echo $result;
   } else {
      // Handle unknown action
      echo 'Unknown action: ' . $action;
   }
}
?>

<?php
   function callGetUltimatePrereqs($param) {
      $url = 'https://cis3760f23-14.socs.uoguelph.ca/api/get_ultimate_prereqs/index.php';
      $data = ['courseCodes' => $param];

      // use key 'http' even if you send the request to https://...
      $options = [
         'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
         ],
      ];

      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      if ($result === false) {
         echo "error with api call (code 1000)";
      }

      // var_dump($result);


      return $result;
   }
?>
