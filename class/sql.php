<?php

//Criamos uma classe SQL que extende da classe de PDO que ja tem no sistema
class Sql extends PDO {

	private $conexao;

	public function __construct(){
		// o $this esta inserindo estas informações dentro da variavel privada conexao
		$this->conexao = new PDO ("mysql:host=localhost;dbname=dbphp7","root","");
	}

	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {

			$this->setParam($key, $value);
		}
	}

	public function setParam($statment, $key, $value){

		$statment->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conexao->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;
	}

	public function select ($rawQuery, $params = array())
	{
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



}


?>