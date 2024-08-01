<?php
$urlContents =file_get_contents("https://www.fruityvice.com/api/fruit/all");

$fruitArray =json_decode($urlContents, true);

$error ="";

if($fruitArray == null){
    $error ="no fruit available.";

}
$fruitinfo="";
if(array_key_exists('fruit_name', $_GET)){
    $fruitname=$_GET['fruit_name'];

    $urlsinglefruit=file_get_contents("https://www.fruityvice.com/api/fruit/" .$fruitname);

$fruitinfo=json_decode($urlsinglefruit, true);


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fruiryvice API</title>
</head>
<body>


<h2>select a fruit</h2>
<form method="get">
<select name="fruit_name" id="">

<?php 
    if($error ==""){
         for($i= 0; $i < count($fruitArray); $i++){
            echo '<option value="'.
            $fruitArray[$i]['name']. '">'.
            $fruitArray[$i]['name']. 
            '</option>';
         }
         $fruitArray[$i]['name']. '</option>';
    }
else{
    echo '<span> woops, no content.error is'. $error.'<span>';
}   
?> 

</select>

<input type="submit" value="get fruit info">
</form>

    <?php
    if($fruitinfo!=""){
        $spaces="&nbsp;&nbsp;&nbsp";
        echo "genus:".$fruitinfo['genus']."<br>";
        echo "family: ".$fruitinfo['family']."<br>";
        echo "order:".$fruitinfo['order']."<br>";
        echo "<strong> nutrients:</strong> <br>";
        echo $spaces."carbs:" . $fruitinfo['nutritions']['carbohydrates']."<br>";
        echo $spaces."protein:" . $fruitinfo['nutritions']['protein']."<br>";
        echo $spaces."fat:" . $fruitinfo['nutritions']['fat']."<br>";
        echo $spaces."calories:" . $fruitinfo['nutritions']['sugar']."<br>";
    
    }
    
    ?>

</body>
</html>