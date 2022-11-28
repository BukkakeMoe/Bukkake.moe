<?php
require_once("includes/header.php");

function read_and_delete_first_line($filename) {
  $file = file($filename);
  $output = $file[0];
  unset($file[0]);
  file_put_contents($filename, $file);
  return $output;
}
$thisID = $_GET['id'];
$sqlQuery = "SELECT * FROM videos WHERE id=$thisID";
$sqlQuery2 = "SELECT * FROM videos WHERE intensity IS NULL OR intensity = ''";
$query2 = $con->prepare($sqlQuery2);
$query2->execute();
While($row2 = $query2->fetch(PDO::FETCH_ASSOC)){
  echo '<a id="item" href="https://bukkake.moe/convert.php?id='.$row2['id'].'">'.$row2['id'].'</a><br>';



}

$query = $con->prepare($sqlQuery);
$query->execute();
$i = 0;
$arr1 = array();
$arr2 = array();
  While($row = $query->fetch(PDO::FETCH_ASSOC)){
    
      
      
        echo $row['funScript'].'<br>';
      $contents = file_get_contents('fs/'.$row['funScript']);

      if(strpos($contents,'#')!== false){
        $comment = read_and_delete_first_line('fs/'.$row['funScript']);
        $contents = str_replace($comment, '', $contents);
      }else{
        echo 'no more';
      }
      $contents = preg_replace('/\s+/',',',$contents);
      $array = explode(",", $contents);
      $output = preg_split('/ (,| ) /', file_get_contents('fs/'.$row['funScript']));

      foreach($array as $key => $value){
        if(is_numeric($value) == true) {
        if($i%2 == 0){
            array_push($arr1,$value);
          
        }else{
            array_push($arr2,$value);

        }
      }
        $i++;
    }

      $decoded_json = json_decode($jsonData, true);
      $a = 0;
      $intensitySum = 0;
    
      foreach($arr1 as $fsPos){
        $firstPos = (int)$arr2[$a];
        $secondPos = (int)$arr2[$a-1];;
        $firstAct = (int)$arr1[$a];
        $secondAct = (int)$arr1[$a-1];

        if($secondAct < $firstAct){
          $temp = $secondAct;
          $secondAct = $firstAct;
          $firstAct = $temp;
        }
        $intensitySum += getIntensity($firstAct,$secondAct,$firstPos,$secondPos);

        $a++;
    
        if($a == count($arr1)){
          $id =$row['id'];
          $inten = round($intensitySum / count($arr1));
          $sql = "UPDATE videos SET intensity=$inten WHERE id=$id";
          echo $sql;
          $result = $con->prepare( $sql);
          $result->execute();
    
        }
        
        }
      
  }



function getIntensity($a1,$a2,$p1,$p2) {
   $slope = min(20, 1000.0 / ($a2 - $a1));
  return $slope * abs($p2 - $p1);
}
?>
<body>

<script>
var but = document.querySelector("[id='item']");
  //  setInterval(function () {but.click();},1000);

</script>
</body>
