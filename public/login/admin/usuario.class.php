<?php

	require_once 'pdo.class.php';

	class Usuario{	
		var $habilitado, $senha, $cpf, $funcao;

		function logar($cpf, $senha, $habilitado, &$total){
			$this->habilitado   = $habilitado;
			$this->cpf      	= $cpf;
			$this->senha    	= md5(hash('sha512', $senha));
			$this->funcao      	= 'Admin';			

			$conn = Database::conexao();

					$busca = $conn->prepare("
					SELECT * FROM tbl_user u, tbl_funcao f, tbl_historico h, tbl_evento e 
						WHERE  u.senha_user = :SENHA 
							AND u.cpf_user = :CPF
								AND u.habilitado = :HABILITA
									AND f.id_funcao = u.fk_funcao
										AND h.fk_iduser = u.iduser
											AND e.id_evento = h.fk_idevento
												AND e.satus_evento = 1
					");

					$busca->bindValue(":SENHA", $this->senha, PDO::PARAM_STR);
					$busca->bindValue(":CPF", $this->cpf, PDO::PARAM_STR);
					$busca->bindValue(":HABILITA", $this->habilitado, PDO::PARAM_STR);
					$busca->execute();
					$total = $busca->rowCount();
					$resulta_busca = $busca->fetchAll(PDO::FETCH_OBJ);
					return $resulta_busca;
			
		
		}

    }

?>