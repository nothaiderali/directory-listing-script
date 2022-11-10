<!--Directory-Listing-Script-v1.0-->
<html>
<head>
<meta charset="utf-8" content="width=device-width" name="viewport">
<style>
html{
  -webkit-text-size-adjust: 100%;
}
form{
  margin-top: 3px;
  margin-bottom: 3px;
}
</style>
</head>
<body>
<?php
$dir = ".";
$files = "";

if ($_POST){
$dir = $_POST["path"]."/".$_POST["folder"];
}

echo '<b>Index of '.substr($dir, 0).'</b><br>';

if ($opendirectory = opendir($dir)){

while (($list = readdir($opendirectory)) !== false){

if ($list !== "." and $list !== ".."){

if (is_dir($dir.'/'.$list)){

echo "<form method='post'>
<input type='hidden' name='path' value='$dir'/>
<input type='submit' name='folder' value='$list'/>
</form>";

}
else{

$files = $files."<a href='".$dir.'/'.$list."'>".$list."</a><br>";

}
}
}
echo $files;
}
?>
<!--
</body>
</html>