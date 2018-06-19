<?php header("Access-Control-Allow-Origin: *");

	include('../model/coloniadeferiasModel.php');

	class coloniadeferiasDAO {		

		private $conn;

		public function __construct() {
			$conn = new PDO("mysql:host=br226.hostgator.com.br;dbname=novab704_comerciarios", "novab704_comerc", "appcomerciarios15");
			$conn->exec("SET CHARACTER SET utf8");
    		$conn->exec("SET NAMES 'utf8'");
			$conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $this->conn = $conn;
	    }

		public function getAll() {
	        $statement = $this->conn->query(
	            'SELECT * FROM app_coloniadeferiastable order by tipo asc'
	        );
	        return $this->processResults($statement);
	    }


	    private function processResults($statement) {
	        $results = array();
         	$resultsPage = array();
	 	
	        if($statement) {
	            while($row = $statement->fetch(PDO::FETCH_OBJ)) {
	                $post = new coloniadeferias();
	 
	 				$post->setId($row->id);
	                $post->setTipo($row->tipo);
	                $post->setTitulo($row->titulo);
	                $post->setValorUm($row->valorUm);
	                $post->setValorDois($row->valorDois);
	 
	                if($post->tipo == 1){
                		$resultsOne[] = $post;
	                }else if($post->tipo == 2){
						$resultsTwo[] = $post;
	                }
	                else if($post->tipo == 3){
						$resultsThree[] = $post;
	                }
	                else if($post->tipo == 4){
						$resultsFour[] = $post;
	                }
	                else if($post->tipo == 5){
						$resultsFive[] = $post;
	                }
	                else if($post->tipo == 6){
						$resultsSix[] = $post;
	                }

	            }
	            
	            $resultsPage['resultsOne'] = $resultsOne;
	            $resultsPage['resultsTwo'] = $resultsTwo;
	            $resultsPage['resultsThree'] = $resultsThree;
	            $resultsPage['resultsFour'] = $resultsFour;
	            $resultsPage['resultsFive'] = $resultsFive;
	            $resultsPage['resultsSix'] = $resultsSix;
	        }
	 
	        return json_encode($resultsPage);
	    }
	}

?>