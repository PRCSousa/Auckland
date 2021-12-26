<?php
include 'menu.php';
include 'config.php';

if(!isset($_GET["ID"])){
  #header("Location:info_form.php?Value=Erro");
}else{
$id = $_GET["ID"];
$sql = "SELECT Nome,tempo_1_sts, tempo_2_sts, tempo_3_sts, tempo_4_sts, tempo_5_sts, tempo_1_tug, tempo_2_tug, tempo_3_tug, peso_esq_ft, peso_dir_ft, peso_esq_ts FROM resultados WHERE ID = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
 ?>
 <head>
 <title>Análise | Auckland</title>
 <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
 <script type="text/javascript" src="canvasjs.min.js"></script>
 <script type="text/javascript">
 $(function() {
 	$(".chartContainer").CanvasJSChart({
 		title: {
 			<?php echo 'text: "Teste STS de '.$row["Nome"].'"' ?>
 		},
 		axisY: {
 			title: "Tempo em Segundos",
 			includeZero: false
 		},
 		axisX: {
      title: "Checkpoints",
 			interval: 5
 		},
 		data: [
 		{
 			type: "line", //try changing to column, area
 			toolTipContent: "{label}: {y} seg ",
 			dataPoints: [
        <?php
      echo '  { label: "1 subida",  y: '.$row["tempo_1_sts"] / 1000 .' },';
      echo '  { label: "2 subida",  y: '.$row["tempo_2_sts"] / 1000 .' },';
      echo '  { label: "3 subida",  y: '.$row["tempo_3_sts"] / 1000 .' },';
      echo '  { label: "4 subida",  y: '.$row["tempo_4_sts"] / 1000 .' },';
      echo '  { label: "5 subida",  y: '.$row["tempo_5_sts"] / 1000 .' }';
 				?>
 			]
 		}
 		]
 	});
 });
 </script>
 <script type="text/javascript">
 $(function() {
   $(".chartContainer2").CanvasJSChart({
     title: {
       <?php echo 'text: "Teste TUG de '.$row["Nome"].'"' ?>
     },
     axisY: {
       title: "Tempo em Segundos",
       includeZero: false
     },
     axisX: {
      title: "Checkpoints",
       interval: 5
     },
     data: [
     {
       type: "line", //try changing to column, area
       toolTipContent: "{label}: {y} seg ",
       dataPoints: [
        <?php
      echo '  { label: "1.5m",  y: '.$row["tempo_1_tug"] / 1000 .' },';
      echo '  { label: "4.5m",  y: '.$row["tempo_2_tug"] / 1000 .' },';
      echo '  { label: "sentar",  y: '.$row["tempo_3_tug"] / 1000 .' }';;
         ?>
       ]
     }
     ]
   });
 });
 </script>


 </head>
 <body>
     <div class="chartContainer"  style="    display: inline-block;"></div>
      <div class="chartContainer2"style="    display: inline-block;"></div>
       <?php
          include 'config.php';
          $filtro_id = $_GET["ID"];;
          $sql = "SELECT Nome, Idade, NIF, Contacto, tempo_1_sts, tempo_2_sts, tempo_3_sts, tempo_4_sts, tempo_5_sts, tempo_1_tug, tempo_2_tug, tempo_3_tug FROM resultados WHERE ID = $filtro_id";
          $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  $media1 = (1.5 / $row["tempo_1_tug"] / 1000)* 1000000;
                  $media2 = 3 / ($row["tempo_2_tug"] - $row["tempo_1_tug"]) /1000 * 1000000;
                  $media3 = 4.5 / ($row["tempo_3_tug"] - $row["tempo_2_tug"]) /1000 * 1000000;
    echo"<table width='30%' !important border='1' style='float:left !important;'>";
    echo"       <colgroup span='2'></colgroup>";
    echo"     <th colspan='2' scope='colgroup' class='tdanaliseheader'>Teste STS</th>";
    echo"   <tr>";
    echo "    <td class='tdanalise'> Total </td>";
    echo"     <td class='tdanalise'> <p> " . $row["tempo_5_sts"] / 1000 . " seg </p> </tr>";
    echo"   <tr>";
    echo "    <td class='tdanalise'> Média </td>";
  echo"     <td class='tdanalise'> <p> " . ($row["tempo_1_sts"] / 1000 + ($row["tempo_2_sts"] - $row["tempo_1_sts"]) / 1000 + ($row["tempo_3_sts"] - $row["tempo_2_sts"]) / 1000 + ($row["tempo_4_sts"] - $row["tempo_3_sts"]) / 1000 + ($row["tempo_5_sts"] - $row["tempo_4_sts"]) / 1000) / 5 . " seg </p> </tr>";
  echo"<table width='30%' !important border='1' !important style='float:left !important;'>";
  echo"       <colgroup span='2'></colgroup>";
  echo"     <th colspan='2' scope='colgroup' class='tdanaliseheader'>Teste TUG</th>";
  echo"   <tr>";
  echo"    <td class='tdanalise'> Total </td>";
  echo"     <td class='tdanalise'> <p> " . $row["tempo_3_tug"] / 1000 . " Seg </p> </tr>";
  echo"     <tr>";
  echo"    <td class='tdanalise'> Velocidade Média Inicial </td>";
  echo"     <td class='tdanalise'> <p> " . round($media1, 2)." m/s </p> </tr>";
  echo"    <td class='tdanalise'> Velocidade Média Intermédia </td>";
  echo"     <td class='tdanalise'> <p> " . round($media2, 2) ." m/s </p> </tr>";
  echo"    <td class='tdanalise'> Velocidade Média Final </td>";
  echo"     <td class='tdanalise'> <p> " . round($media3, 2) ." m/s </p> </tr>";
  echo" <table width='30%' !important border='1' !important style='float:left !important;'>";
  echo"       <colgroup span='2'></colgroup>";
  echo"     <th colspan='2' scope='colgroup' class='tdanaliseheader'>Dados Pessoais</th>";
  echo"   <tr>";
  echo"    <td class='tdanalise'> Nome </td>";
  echo"     <td class='tdanalise'> <p> " . $row["Nome"] . " </p> </tr>";
  echo"   <tr>";
  echo"    <td class='tdanalise'> Idade </td>";
  echo"     <td class='tdanalise'> <p> " . $row["Idade"] . " </p> </tr>";
  echo"   <tr>";
  echo"    <td class='tdanalise'> NIF </td>";
  echo"     <td class='tdanalise'> <p> " . $row["NIF"] . " </p> </tr>";
  echo"   <tr>";
  echo"    <td class='tdanalise'> Contacto </td>";
  echo"     <td class='tdanalise'> <p> " . $row["Contacto"] . " </p> </tr>";
  echo"   <tr>";
  echo"    <td class='tdanalise'> Data </td>";
  echo"     <td class='tdanalise'> <p> " . date('d/m/Y') . " </p> </tr>";
  echo"   </table>";
  } } ?>

 </body>
<?php } ?>
