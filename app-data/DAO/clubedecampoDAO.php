<?php header("Access-Control-Allow-Origin: *");

	include('../model/clubedecampoModel.php');
	//include('FunctionsDAO.php');

	class clubedecampoDAO {		

		private $conn;
		//public $clubedecampo;

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
	            'SELECT * FROM app_clubedecampotable as appcdc order by tipo asc'
	        );
	        return $this->processResults($statement);
	    }


	    private function processResults($statement) {
	        $results = array();
         	$resultsPage = array();
	 	
	        if($statement) {
	            while($row = $statement->fetch(PDO::FETCH_OBJ)) {
	                $post = new clubedecampo();
	 
	 				$post->setId($row->id);
	                $post->setTipo($row->tipo);
	                $post->setTitulo($row->titulo);
	                $post->setValor($row->valor);
	 
	                if($post->tipo == 1){
                		$resultsOne[] = $post;
	                }else if($post->tipo == 2){
						$resultsTwo[] = $post;
	                }
	                else if($post->tipo == 3){
						$resultsThree[] = $post;
	                }

	            }

	            $resultsPage['resultsOne'] = $resultsOne;
	            $resultsPage['resultsTwo'] = $resultsTwo;
	            $resultsPage['resultsThree'] = $resultsThree;
	        }
	 
	        return json_encode($resultsPage);
	    }
	}

?>