      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; </strong> Todos os Direitos Reservados
      </footer>
      <div class="control-sidebar-bg"></div>
    </div>
    <script src="public/dist/js/adminlte.min.js"></script>
<!-- 
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 
-->
    <script src="public/bower_components/layout/jquery-3.2.1.min.js"></script>
    <script src="public/bower_components/layout/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    
    <script>
        $(document).ready(function(){
            $('#minhaTabelaA').DataTable({
                  "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)"
                }
            });

            $('#minhaTabelaB').DataTable({
                  "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)"
                }
            });  

            $('#minhaTabelaC').DataTable({
                  "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)"
                }
            });
             
            $('#minhaTabelaD').DataTable({
                  "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)"
                }
            });
            $('#minhaTabelaE').DataTable({
                  "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum registro disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)"
                }
            });
        });
        
        function getAudio(){
          var txt=jQuery('#txt').val()
          jQuery.ajax({
            url:'get.php',
            type:'post',
            data:'txt='+txt,
            success:function(result){
              jQuery('#player').html(result);
            }
          });
        }

        function disableRightClick(e){
          var message = "Desabilitado pelo Administrador : Esp. Paulo Tarciso'";

          if(!document.rightClickDisabled) // initialize
          {
          if(document.layers)
          {
          document.captureEvents(Event.MOUSEDOWN);
          document.onmousedown = disableRightClick;
          }
          else document.oncontextmenu = disableRightClick;
          return document.rightClickDisabled = true;
          }
          if(document.layers || (document.getElementById && !document.all))
          {
          if (e.which==2||e.which==3)
          {
          alert(message);
          return false;
          }
          }
          else
          {
          alert(message);
          return false;
          }
        }
    //    disableRightClick();    


    </script>

   </body>
</html>
