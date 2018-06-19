<?php header("Content-Type:text/html; charset=UTF-8");
	include '../../aut.php';
	include '../../access.php';

  try{
    $pergunta_id = addslashes($_POST['pId']);
    $pergunta = addslashes($_POST['pergunta']);
    $venc_dia = addslashes($_POST['venc_dia']);
    $venc_mes = addslashes($_POST['venc_mes']);
    $venc_ano = addslashes($_POST['venc_ano']);
    $respostaA = addslashes($_POST['respostaA']);
    $respostaB = addslashes($_POST['respostaB']);
    $respostaC = addslashes($_POST['respostaC']);
    $respostaD = addslashes($_POST['respostaD']);
    $vencimento = $venc_ano . '-' . $venc_mes . '-' . $venc_dia;
    
    $query = "INSERT INTO app_enquetes_perguntas (`id`, `pergunta`, `status`, `vencimento`) VALUES ('$pergunta_id', '$pergunta', 'ativada', '$vencimento')";
    mysqli_query($conexao, $query) or die(mysqli_error($conexao)); 

    $queryPergunta = "INSERT INTO app_enquetes_respostas
        (`opcao`, `pergunta_id`, `resposta`)
      VALUES
        ('A', '$pergunta_id', '$respostaA'),
        ('B', '$pergunta_id', '$respostaB'),
        ('C', '$pergunta_id', '$respostaC'),
        ('D', '$pergunta_id', '$respostaD')";
    mysqli_query($conexao, $queryPergunta) or die(mysqli_error($conexao));

    echo "O conteúdo da enquete foi inserido com sucesso!";
    echo '<br><br><a href="javascript:history.back()">Voltar</a>';
  }catch (Exception $e) {
    echo 'Erro inesperado: ',  $e->getMessage(), "\n";
  }

?>