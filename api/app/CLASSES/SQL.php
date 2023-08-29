<?php
    namespace App\CLASSES;
    use \App\DB\CONEXAO;

class SQL extends CONEXAO
{
    

    private $sql;
    protected $tabela,$colunas,$values,$data,$comandos,$colunaid,$valueid;

    protected function setTabelas($tbl){
        $this->tabela=$tbl;
    }
    protected function setColunas($cln){
        $this->colunas=$cln;
    }
    protected function setValues($vls){
        $this->values=$vls;
    }
    protected function setComandos($cmd){
        $this->comandos=$cmd;
    }
    protected function setIdColunas($idc){
        $this->colunaid=$idc;
    }
    protected function setIdValues($idv){
        $this->valueid=$idv;
    }
    protected function getData(){
        return $this->data;
    }

    protected function Insert() : array
    {
        $this->sql = "INSERT INTO ".$this->tabela." (".$this->colunas.") VALUE (".$this->values.")";
        $this->stmt=self::execute($this->sql);
        if ($this->stmt) {return [];}
        return[];
    } 
    
    protected function Select() : array
    {
        $this->sql = "SELECT $this->colunas FROM $this->tabela $this->comandos";
        self::execute($this->sql);
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    } 
    protected function Update() : array
    {
        $this->sql = "UPDATE ".$this->tabela." SET ".$this->values." WHERE ".$this->colunaid." = ".$this->valueid." ";
        $this->stmt=self::execute($this->sql);
        if ($this->stmt) {return [];}
        return[];
    } 
    protected function Delete() : array
    {
        $this->sql = "DELETE FROM ".$this->tabela." WHERE ".$this->colunaid." = ".$this->valueid." ";
        $this->stmt=self::execute($this->sql);
        if ($this->stmt) {return [];}
        return[];
    }

    public function criarDados($tabela,$colunas,$valores){
        self::setTabelas("$tabela");
        self::setColunas("$colunas");
        self::setValues("$valores");
        return @$data['dados']=self::Insert();
    }
    public function BuscarDados($tabela,$colunas, $comando){
        self::setTabelas("$tabela");
        self::setColunas("$colunas");
        self::setComandos("$comando");
        return @$data['dados']=self::Select();
    }
    public function AtualizarDados($tabela,$valores,$idcolunas,$idvalor){
        self::setTabelas("$tabela");
        self::setValues("$valores");
        self::setIdColunas("$idcolunas");
        self::setIdValues("$idvalor");
        return @$data['dados']=self::Update();
    }
    public function ApagarDados($tabela,$idcolunas,$idvalor){
        self::setTabelas("$tabela");
        self::setIdColunas("$idcolunas");
        self::setIdValues("$idvalor");
        return @$data['dados']=self::Delete();
       
    }


}
    



?>