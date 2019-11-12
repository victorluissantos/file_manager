<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * @see responsável por ler um arquivo
 * @param [File] $arquivo, nome do arquivo o qual desejo ler
 * @param [Boolean] $debug, variavel que determina se será exibida dentro da função
*/
function ler($arquivo, $debug=false) {
	$meuArray = Array();
	$file = fopen($arquivo, 'r');
	while (($line = fgetcsv($file)) !== false)
	{
	  $meuArray[] = $line;
	}
	fclose($file);
	if ($debug) {
		echo '<pre>';
		var_dump($meuArray);
	} else {
		return $meuArray;
	}
}

/**
 * @see Responsável por criar arquivos .csv
 * @param [String] $nomeArquivo, nome do arquivo a ser gerado
 * @param [Array] $data, conteúdo a ser salvo no arquivo
 * @param [Boolean] $download, determina se o arquivo sera gravado em disco ou baixado
 * @param [Boolean] $debug, determina se será printado o conteúdo salvo
*/
function criar($nomeArquivo, $data=null, $cabecalho=null, $download=false, $dynamic_name=false, $debug=false) {

	$arr = array(
		'type' => 'danger',
		'msg' => 'Ação indevida !'
		);
	if (isset($nomeArquivo)) {
		$arr = array(
			'type' => 'warning',
			'msg' => 'Dependencias não informadas !'
			);
		if (!empty($nomeArquivo)) {
			$arra = array(
				'type' => 'success',
				'msg' => 'Arquivo criado com sucesso'
				);

			if ($dynamic_name) {
				$nomeArquivo = $nomeArquivo.'_'.date('d-m-Y').'.csv';
			} else {
				$nomeArquivo = $nomeArquivo.'.csv';
			}
			$file = fopen($nomeArquivo, 'wx+');	
			
			if (!is_null($cabecalho)) {
				fputcsv($file, $cabecalho);
			}
			foreach ($data as $row) {
				fputcsv($file, $row);
			}
			if ($download) {
				header('Content-type: application/csv');
				header('Content-Disposition: attachment; filename='.$nomeArquivo.';');
				header('Content-Transfer-Encoding: binary');
				header('Pragma: no-cache');

				header("Location: ".$nomeArquivo);
			}
			
			fclose($file);

			if ($debug) {
				echo '<pre>';
				var_dump($data);
			}
		}
	}
	return json_encode($arr);
}

$matrix = array(
			array('adamastro pitagoras','adamastor@email.com','365216'),
			array('Clevio pitagoras','clevinhos@email.com','ds654'),
			array('Claudio pitagoras','claus@email.com','98784'),
			);


criar('victor', $matrix, array('Nome', 'Email', 'Senha'), true, true);













function escrever() {
	$filename = "testFile.csv";
	$FileHandle = fopen ( $filename , 'w ');
	fwrite ( $fileHandle , "valor 1 , valor 2, valor 3 ");
	fclose ( $fileHandle );
}

