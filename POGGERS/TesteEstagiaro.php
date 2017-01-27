<?php
//Questão 01 - 0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144, 233, 377, 610, 987, 1597, 2584
function fibonacci($termo) {
	if($termo == 0)
		return 0;
	else
		if ( $termo == 1 )
			return 1;
		else
			return  fibonacci($termo - 1) + fibonacci($termo - 2) ;
}
function sequenciaFibonacci($enesimo) {
	for($i = 1; $i <= $enesimo; $i++)
		echo fibonacci($i).', ';
}
//sequenciaFibonacci(12);
//echo '<br>';

//Questão 02
function fixAlgorithm() {
	$i = 0;
	while ($i < 100) {
		echo ++$i;
		if($i % 3 == 0) echo 'BUZZ';
		if($i % 5 == 0) echo 'BIZZ';
		echo ', ';
	}
}

//Questão 03
function quickSort(&$vetor, $esquerda, $direita) {
	$pivo = $esquerda;
	for($i = $esquerda + 1; $i <= $direita; $i++) {
		$j = $i;
    if($vetor[$j] < $vetor[$pivo]) {
   		$ch= $vetor[$j];
			while($j > $pivo){
				$vetor[$j] = $vetor[$j-1];
				$j--;
			}
			$vetor[$j] =	$ch;
			$pivo++;
    }
  }

	if($pivo-1 >= $esquerda){
		quickSort($vetor, $esquerda, $pivo-1);
	}

	if($pivo+1 <= $direita){
		quickSort($vetor, $pivo+1, $direita);
	}

}
function juntaEOrdena($a, $b) {
	$c = array_merge($a, $b);
	quickSort($c, 0, count($c)-1);
	return $c;
}
$vetorA = [75, 9, 67, 54, 3];
$vetorB =	[21, 27, 5, 10, 99];
$vetorC = juntaEOrdena($vetorA, $vetorB);
/*
echo '<pre>';
print_r($vetorC);
echo '</pre>';
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Teste Estagiario - Poggers</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<div class="container">
			<div class="page-header">
    		<h1>Teste Estagiario - <span class="label label-warning">Poggers</span></h1>
			</div>

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#question01" aria-controls="home" role="tab" data-toggle="tab">Questão 01</a></li>
		    <li role="presentation"><a href="#question02" aria-controls="profile" role="tab" data-toggle="tab">Questão 02</a></li>
		    <li role="presentation"><a href="#question03" aria-controls="messages" role="tab" data-toggle="tab">Questão 03</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="question01">
					<h4><span class="label label-warning">1.</span> A sequência de Fibonacci possui uma grande relevância no mundo da matemática. A sequência é definida recursivamente a partir das seguintes equações:<br>
						F 1 =1,F 2 =1 F n = F n-1 + F n-2<br>
						<br>
						Se escrevermos a sequência de Fibonacci até o seu 12o termo (F1 2 ), teríamos:<br>
						1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144<br>
						<br>
						Escreva o código de Fibonacci em PHP ou pseudocódigo para encontrar o enésimo (no) termo da sequência de Fibonacci.
					</h4>
					<h3>Resposta:</h3>
					<pre><?php sequenciaFibonacci(12); ?></pre>
				</div>
		    <div role="tabpanel" class="tab-pane" id="question02">
					<h4><span class="label label-warning">2.</span> Participando de um processo seletivo, um candidato respondeu a seguinte questão: Escreva uma função que imprima os números de 1 a 100 e, ao lado dos números múltiplos de 3 imprima “BUZZ”, ao lado dos múltiplos de 5 imprima “BIZZ” e ao lado dos múltiplos de 3 e 5 imprima “BUZZBIZZ”</h4>
					<h3>Resposta:</h3>
					<pre><?php fixAlgorithm(); ?></pre>
				</div>
		    <div role="tabpanel" class="tab-pane" id="question03">
					<h4><span class="label label-warning">3.</span> Dados dois vetores A e B não necessariamente ordenados, escreva um código que retorne um vetor C, ordenado, contendo a união dos elementos de A com B.</h4>
					Vetor A:
					<pre><?php print_r($vetorA); ?></pre>
					Vetor B:
					<pre><?php print_r($vetorB); ?></pre>

					<h3>Resposta:</h3>
					Vetor C:
					<pre><?php print_r($vetorC); ?></pre>
				</div>
		  </div>

		</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
