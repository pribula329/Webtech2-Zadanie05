<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="script.js"></script>
    <link rel="stylesheet" href="dizajn.css">
</head>
<body >
<section class="container">
    <h1>SSE Generátor</h1>
    <div id="result" class="row">
        <div class="col-6">
            <div class="badge bg-primary text-wrap parametre" id="konzolaA">

            </div>
        </div>
        <div class="col-6">
            <div class="badge bg-primary text-wrap parametre" id="konzolaX" >

            </div>
        </div>
    </div>
    <br>
    <div id="ypsilony" class="row">
        <div class="col-4">
            <div class="badge bg-primary text-wrap hodnoty" id="konzolaY1">

            </div>
        </div>
        <div class="col-4">
            <div class="badge bg-primary text-wrap hodnoty" id="konzolaY2" >

            </div>
        </div>
        <div class="col-4">
            <div class="badge bg-primary text-wrap hodnoty" id="konzolaY3" >

            </div>
        </div>
    </div>
</section>



<div class="formular">
    <form action="index.php" method="post">
        <div class="form-row">
        <div class="mb-3">
            <label for="konstanta" class="form-label">Konštanta</label>
            <input type="number" class="form-control" id="konstanta" name="konstanta">
        </div>
        <div class="mb-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" name="y1" id="y1">
            <label class="form-check-label" for="y1">Y1</label>
        </div>
        <div class="mb-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" name="y2" id="y2">
            <label class="form-check-label" for="y2">Y2</label>
        </div>
        <div class="mb-3 form-check form-check-inline">
            <input type="checkbox" class="form-check-input" name="y3" id="y3">
            <label class="form-check-label" for="y3">Y3</label>
        </div>
        <div>
            <span>Po zaškrtnutí/odškrtnutí musite taktiež odoslať formulár</span>
        </div>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<script>

vykreslovanie();


</script>



</body>
</html>


<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
if (isset($_POST['konstanta']) && !empty($_POST['konstanta'])){


    if(isset($_POST['y1'])){
        $y1=1;
    }
    else{
        $y1=0;
    }

    if(isset($_POST['y2'])){
        $y2=1;
    }
    else{
        $y2=0;
    }
    if(isset($_POST['y3'])){
        $y3=1;
    }
    else{
        $y3=0;
    }

    include ("login.php");
    $conn = pokusLogin();
    $stm = $conn->prepare("UPDATE konstanta SET konstanta=?,y1=?,y2=?,y3=?  WHERE konstanta.id=1");
    $stm->bindValue(1,$_POST["konstanta"]);
    $stm->bindValue(2,$y1);
    $stm->bindValue(3,$y2);
    $stm->bindValue(4,$y3);

    $stm->execute();

}
elseif(isset($_POST['y1']) || isset($_POST['y3']) || isset($_POST['y3'])){

    if(isset($_POST['y1'])){
        $y1=1;
    }
    else{
        $y1=0;
    }

    if(isset($_POST['y2'])){
        $y2=1;
    }
    else{
        $y2=0;
    }
    if(isset($_POST['y3'])){
        $y3=1;
    }
    else{
        $y3=0;
    }

    include ("login.php");
    $conn = pokusLogin();
    $stm = $conn->prepare("UPDATE konstanta SET y1=?,y2=?,y3=?  WHERE konstanta.id=1");
    $stm->bindValue(1,$y1);
    $stm->bindValue(2,$y2);
    $stm->bindValue(3,$y3);

    $stm->execute();
}

?>
