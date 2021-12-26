<head>
</head>

<table id="datatable" style="width: 100%" >
<script>
    document.getElementById('nome_div').onChange()
      {

      }
</script>
<script>
    document.getElementById('nome_idade').onChange()
      {

      }
</script>
<?php

  $filtro_id = $_POST['user'];
  if (is_numeric($filtro_id)) {
    require('config.php');
    $sql = "SELECT ID, Nome, Idade, Sexo, NIF, Localidade, Morada, Contacto FROM resultados WHERE ID = $filtro_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo"<div>";
       echo "<tr>";
         echo "<td class='textbxinput'> Nome </td>";
         echo "<td class='textbxinput'> <div   ><input class='textbx' type='text' name='nome' value='" . $row["Nome"] . "'></div> </td>";
       echo "</tr>";
       echo "<tr>";
         echo "<td class='textbxinput' > Idade </td>";
         echo "<td class='textbxinput'><div><input class='textbx' type='number' name='idade' value='".$row["Idade"]."'></div></td>";
       echo "</tr>";
       echo "<tr>";
         echo "<td class='textbxinput' > Sexo </td>";
         echo "<td class='textbxinput'> <div   ><input class='textbx' type='text' name='sexo' value='" . $row["Sexo"] . "' pattern='[M,F,f,m]' required='required' maxlenght='1'> </div> </td>";
       echo "</tr>";
       echo "<tr>";
         echo "<td class='textbxinput' > NIF </td>";
         echo "<td class='textbxinput'> <div   ><input class='textbx' type='number' name='nif' value='" . $row["NIF"] . "' pattern='[0-9]' required='required' maxlenght='9'> </div> </td>";
       echo "</tr>";
       echo "<tr>";
         echo "<td class='textbxinput' > Localidade </td>";
         echo "<td class='textbxinput'> <div   ><input class='textbx' type='text' name='localidade' value='" . $row["Localidade"] . "' required='required'> </div> </td>";
       echo "</tr>";
       echo "<tr>";
         echo "<td class='textbxinput' > Morada </td>";
         echo "<td class='textbxinput'> <div   ><input class='textbx' type='text' name='morada'  value='" . $row["Morada"] . "' required='required'> </div> </td>";
       echo "</tr>";
       echo "<tr>";
         echo "<td class='textbxinput' > Contacto </td>";
         echo "<td class='textbxinput'> <div   ><input class='textbx' type='number' name='contacto' value='" . $row["Contacto"] . "' pattern='[0-9]' maxlenght='9' required='required'> </div> </td>";
       echo "</tr>";
       echo "<tr style='background: #E8ECED !important'><td class='analisetablecell'><a href='InfoGraf_User.php?ID=".$filtro_id."'>Análise</a></td><td class='editartablecell' ><button class='textbx'  type='submit' name='Submit' value='".$filtro_id."'>Editar</button></td></tr>";
       echo"</div>";
       echo "<div class='btnapagar'>";
       echo "<div id='myBtn' onclick='apagar(". $filtro_id ." , ` " . $row['Nome'] . " ` )' style=' margin-left: 15px;'>Apagar</div>";
       echo"</div>";
      }
    } else {
      echo " O ID que procura não existe! ";
    }
  } else {
    echo "Insira um valor numérico.";
  }
?>

</table>
