<?php
include ("login.php");
$conn = pokusLogin();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header("Connection: keep-alive");
header("Access-Control-Allow-Origin: *");

$lastId = $_SERVER["HTTP_LAST_EVENT_ID"];
if (isset($lastId) && !empty($lastId) && is_numeric($lastId)) {
    $lastId = intval($lastId);
    $lastId++;
} else {
    $lastId = 0;
}

while (true) {
    $pole = hodnota($conn);
    $a = $pole['konstanta'];
    $x = $lastId;
    $y1=sin($x*$a)*sin($x*$a);
    $y2=cos($x*$a)*cos($x*$a);
    $y3=sin($x*$a)*cos($x*$a);
    if ($pole['y1']==1 && $pole['y2']==1 && $pole['y3']==1){
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>$y1, "y2"=>$y2, "y3"=>$y3]);
    }
    elseif ($pole['y1']==1 && $pole['y2']==1){
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>$y1, "y2"=>$y2, "y3"=>"nedefinovane"]);
    }
    elseif ($pole['y1']==1 && $pole['y3']==1){
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>$y1, "y2"=>"nedefinovane", "y3"=>$y3]);
    }
    elseif ($pole['y2']==1 && $pole['y3']==1){
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>"nedefinovane", "y2"=>$y2, "y3"=>$y3]);
    }
    elseif ($pole['y1']==1){
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>$y1, "y2"=>"nedefinovane", "y3"=>"nedefinovane"]);
    }
    elseif ($pole['y2']==1){
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>"nedefinovane", "y2"=>$y2, "y3"=>"nedefinovane"]);
    }
    elseif ($pole['y3']==1){
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>"nedefinovane", "y2"=>"nedefinovane", "y3"=>$y3]);
    }
    else{
        $msg = json_encode(["a"=>$a, "x"=>$x, "y1"=>"nedefinovane", "y2"=>"nedefinovane", "y3"=>"nedefinovane"]);
    }

    sse($x,$msg);
    $lastId++;
    ob_flush();
    flush();


    sleep(1);
}

function sse($id, $msg){
    echo "id: $id" . PHP_EOL;
    echo "event: sse".PHP_EOL;
    echo "data: $msg".PHP_EOL.PHP_EOL;
}

function hodnota($conn){

    $stm = $conn->prepare("select * from konstanta WHERE konstanta.id=1");
    $stm->execute();
    $konstanta = $stm->fetch(PDO::FETCH_ASSOC);

    return $konstanta;

}
?>