<?php
define('HOST','localhost');
define('USUARIO','root');
define('SENHA','');
define('DB','songs');

class Model {
  
    protected $LIMIT = 20;
     protected $arrays = array();
    protected $db;
    public $_tabela  = "artista";
    protected $conexao;
    public function __construct() {
        
            $dns = "mysql:host=".HOST.";dbname=".DB;
            try {
                 $this->conexao = new PDO($dns,USUARIO,SENHA);
                 $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                 $this->conexao->exec("SET CHARACTER SET utf8");
                 return $this->conexao;
                 
            } catch (PDOException $exc) {
                // echo "RESULTADO".$exc->getMessage();
               echo json_encode("RESULTADO".$exc->getMessage());
            }

           
//            $this->conexao = mysqli_connect($server_name, $user, $senha, $db_nome);
//            if(mysqli_connect_errno($this->conexao)){
//                echo 'Erro na conexão '
//                .mysqli_connect_error();
//                die();
//            }
           // return $this->conexao;
    }
    
    
    
    
    
    
     public function count_itens($sql_cmd) {
        if ($this->conexao == null || $sql_cmd == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
        try { 
            $d = $this->conexao->prepare($sql_cmd);
            $d->bindValue(1, 'ioi', PDO::PARAM_STR);
            $d->execute();
            $retuns = $d->fetchAll(PDO::FETCH_ASSOC);
            $d->closeCursor();
            return count($retuns);
        } catch (PDOException $ex) {
            die("Error " . $ex->getMessage());
        }
    }
    /*
    public function read($where = null,$limit=null,$offset=null,$orderby=null){
        $vector = array();
        $where = ($where != null ? "where {$where} ":"");
        $limit = ($limit != null ? "limit {$limit}":"");
        $offset = ($offset != null ? "offset {$offset}":"");
        $orderby = ($orderby != null ? "order by {$orderby}":"");
        $tdos = $this->conexao->query("select * from `{$this->_tabela}` {$where} {$orderby} {$limit} {$offset}");
        foreach ($tdos as $linha){
            $vector[] = $linha;
        }
        return $vector; 
    }
    public function readTudo($where = null,$limit=null,$offset=null
            ,$orderby=null,$select=null){
        $vector = array();
        
        $select = ($select != null ? " {$select}":"select * from `{$this->_tabela}`");
        $orderby = ($orderby != null ? " order by {$orderby}":"");
        $where = ($where != null ? "where {$where} ":"");
        $tdos = $this->conexao->query("{$select} {$where} {$orderby}");
        foreach ($tdos as $linha){
            $vector[] = $linha;
        }
         return $vector;
    }
   
    */
   
   protected function isConn() {
        /* $dns = "mysql:host=".HOST.";dbname=".DB;
          try {
          $this->conexao = new PDO($dns,USUARIO,SENHA);
          $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
          $this->conexao->exec("SET CHARACTER SET utf8");
          return TRUE;
          } catch (PDOException $exc) {
          return FALSE;
          } */
        if ($this->conexao == null) {
            $retuns = array('RESULTADO' => 'Não há conexão.');
            return ($retuns);
        }
    }

}
