<!DOCTYPE html>
<html>
  <head>
    <title>Dados | Auckland</title>
    <link rel="stylesheet" href="style.css">
    <script language="javascript" src="jquery-3.5.1.min.js"></script>
    <script language="javascript">
      $(document).ready(function(){
          $("#database").change(function () {
              $("#database").each(function () {
                  user = $(this).val();
                  $.post("gettabela_form.php", { user: user }, function(data){
                      $("#output").html(data);
                  });
              });
          })
      });
    </script>
  </head>
  <body>
    <?php
    include 'menu.php';
     ?>
     <main>
       <label for="database">Insere um ID:</label>
       <input list="databaselist" id="database" class="input-filter">
        <datalist id="databaselist">
         <?php
           include 'config.php';

           $sql = "SELECT ID, Nome FROM resultados ORDER BY ID";
           $result = mysqli_query($conn, $sql);
           mysqli_close($conn);
           if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['ID']."'>" .$row['Nome']. "</option>" ;
            }
           }

          ?>
        </datalist>
        <form method="POST" name="Form" action="Update_FormTable.php" >
        <div id="output" style="margin-left: 4%; margin-right: 4%;" >
        </form>
        </div>

        <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <div class="modal-header">
              <span class="close">&times;</span>
              <h2>Confirmação</h2>
            </div>
            <div class="modal-body">
              <p id="msgmodal"></p>
              <p>Tem a certeza que quer prosseguir?</p>
            </div>
            <div class="modal-footer">
              <a href="" id="btnapagarmodal">Apagar</a>
            </div>
          </div>

        </div>

        <script>
          var modal = document.getElementById("myModal");

          var span = document.getElementsByClassName("close")[0];

          span.onclick = function() {
            modal.style.display = "none";
          }

          window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          }

          function apagar(id , nome) {
            modal.style.display = "block";
            document.getElementById("msgmodal").innerHTML = "Está prestes a tabela de " + nome + " !";
            document.getElementById("btnapagarmodal").href = "apagarlinha.php?ID="+ id;

          }


        </script>
     </main>
  </body>
</html>
