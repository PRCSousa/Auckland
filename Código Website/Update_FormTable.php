


<?php



include "config.php";
if(!isset($_POST['Submit'])){
  header('location:gettabela_form.php');
}else {
  $id= $_POST["Submit"]; $Nome = $_POST["nome"]; $Idade = $_POST["idade"]; $Sexo = $_POST["sexo"]; $NIF = $_POST["nif"]; $Localidade = $_POST["localidade"]; $Morada = $_POST["morada"]; $Contacto = $_POST["contacto"];
  $Idade = intval($Idade);
  $NIF =intval($NIF);
  $Contacto =intval($Contacto);
  $sql = "UPDATE resultados SET Nome = '" . $Nome ."', Idade = " . $Idade .", Sexo = '" . $Sexo . "', NIF = ". $NIF .", Localidade = '". $Localidade ."', Morada = '". $Morada ."', Contacto = ". $Contacto . "  WHERE ID = ".$id;
  if(mysqli_query($conn, $sql)){
    header("location:form.php?Value=True");
  }else {
    header("location:form.php?Value=False");
  }

}



 ?>
