<?php

include "config.php";

$id = $_GET["ID"];

$sql = "DELETE FROM resultados WHERE ID = ".$id;
if(mysqli_query($conn, $sql)){
  header("location:form.php?Value=True");
}else {
  header("location:form.php?Value=False");
}

?>
