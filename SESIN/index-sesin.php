<?php
//Includes necess�rios para o Framework Poseidon
include_once("locution.inc.php");
include_once("parametrage.inc.php");
include_once("fonctions.inc.php");

function gravaLog($mensagem) {
  $hoje = date("Y_m_d");
  $hora = date("H:i:s T");

  $arquivo = fopen("log_.$hoje.txt", "ab");
  fwrite($arquivo, "[{$hoje}][{$hora}] {$mensagem}\r\n");
  fclose($arquivo);
}
function tiraMascara($valor){
  $valor = trim($valor);
  $valor = str_replace(".", "", $valor);
  $valor = str_replace(",", "", $valor);
  $valor = str_replace("-", "", $valor);
  $valor = str_replace("/", "", $valor);
  return $valor;
}

$objRetour = array();
$objRetour["code_retour"] = 1;
$objRetour["msg_erreur"] = "";
$objRetour["tabindex"] = array();

$retour = posconnexion($jeton);
if ($retour) {
  // Locution (Classe respons�vel pela realiza��o de Pesquisas)
  //Exemplo: new Locution(1 para "Ou" e 2 para "E", Tipo de Doc, Campo, Operador, Valor);
  $tabLoc = array();
  $valeurRecherche = "ORGANISATION:SESIN";
  $tabLoc[0] = new Locution(1, "CNF", "DVU", "=", $valeurRecherche); //Preenchendo par�metros para realizar uma pesquisa
  $retour = pos_searchdoc($jeton, count($tabLoc), $tabLoc, &$iNbReponses, &$iAdrPremiereReponse); // Realizando a pesquisa

  if ($retour) {
    $tabNumDoc = array();
    if ($iNbReponses > 0) {
      $retour = pos_getreponsestabnumdoc($jeton, $iAdrPremiereReponse, $iNbReponses, &$tabNumDoc);
      //$tabNumDoc � um array com a lista dos n�meros de documentos em resposta
    }
    else {
      echo "N�o h� respostas para esta busca";
      //[1] - Gravar um log em arquivo com data, hora e o fato que n�o h� respostas
      gravaLog('Nao ha respostas para esta busca.');
    }
    if ($retour) {
      // Para cada documento em resposta (array "$tabNumDoc"):
      foreach ($tabNumDoc as $dwNumDoc) {
        //[2] - Buscar o valor das rubricas RGE e CPF (Veja como fazer no arquivo "Fun��es teste php.pdf")
        $rubricaEncontrada = pos_getallindexdoc ($jeton, $dwNumDoc, &$tabCodeValRub);

        if($rubricaEncontrada) {
          //[3] - Validar o CPF, tirar a m�scara e guardar s� os digitos (Ex.: 123.456.789-12 deve retornar 12345678912)
          $tabCodeModifRub['CPF'] = tiraMascara($tabCodeValRub['CPF']);
          $tabCodeModifRub['RGE'] = tiraMascara($tabCodeValRub['RGE']);

          //[4] - Alterar os valores das r�bricas no banco de dados (Veja como fazer no arquivo "Fun��es teste php.pdf")
          $rubricaModificado = pos_modifidx($jeton, $dwNumDoc, count($tabCodeModifRub), $tabCodeModifRub, &$wBadRub);

          //[5] - Gravar um log em arquivo com data, hora, n�mero de documento e os valores alterados
          if($rubricaModificado) gravaLog('O documento '.$dwNumDoc.' teve seus valores RGE e CPF alterados.');
        }
      }
    }
  }
}


posdeconnexion($jeton);
if (!$retour) {
	$objRetour["code_retour"] = 0;
	$objRetour["msg_erreur"] = get_erreur_poseidon($jeton);
}

print_r($objRetour);
?>
