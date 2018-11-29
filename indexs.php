
        <?php
        include_once './_classes/Banco.php';
        $select = $_REQUEST['select'];
      
        $banco = new Banco();
        $vetor = $banco->selectTodos($banco->conectar(),$select);
        if(count($vetor) == 0){
            echo 'Sem Informacoes a mostrar';
        }else{
            echo json_encode($vetor);
        }
        
        ?>
   