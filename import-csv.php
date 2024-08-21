<?php
	define('PREPEND_PATH', '');
	include_once(__DIR__ . '/lib.php');

	// accept a record as an assoc array, return transformed row ready to insert to table
	$transformFunctions = [
		'Pessoas' => function($data, $options = []) {
			if(isset($data['Estado'])) $data['Estado'] = pkGivenLookupText($data['Estado'], 'Pessoas', 'Estado');
			if(isset($data['Cidade'])) $data['Cidade'] = pkGivenLookupText($data['Cidade'], 'Pessoas', 'Cidade');
			if(isset($data['Bairro'])) $data['Bairro'] = pkGivenLookupText($data['Bairro'], 'Pessoas', 'Bairro');
			if(isset($data['profissao'])) $data['profissao'] = pkGivenLookupText($data['profissao'], 'Pessoas', 'profissao');

			return $data;
		},
		'Eleitores' => function($data, $options = []) {
			if(isset($data['Nome'])) $data['Nome'] = pkGivenLookupText($data['Nome'], 'Eleitores', 'Nome');
			if(isset($data['DataN'])) $data['DataN'] = guessMySQLDateTime($data['DataN']);
			if(isset($data['Zona'])) $data['Zona'] = pkGivenLookupText($data['Zona'], 'Eleitores', 'Zona');
			if(isset($data['secao'])) $data['secao'] = pkGivenLookupText($data['secao'], 'Eleitores', 'secao');
			if(isset($data['partido'])) $data['partido'] = pkGivenLookupText($data['partido'], 'Eleitores', 'partido');
			if(isset($data['indicacao'])) $data['indicacao'] = pkGivenLookupText($data['indicacao'], 'Eleitores', 'indicacao');
			if(isset($data['Estado'])) $data['Estado'] = thisOr($data['Nome'], pkGivenLookupText($data['Estado'], 'Eleitores', 'Estado'));
			if(isset($data['Cidade'])) $data['Cidade'] = thisOr($data['Nome'], pkGivenLookupText($data['Cidade'], 'Eleitores', 'Cidade'));
			if(isset($data['Bairro'])) $data['Bairro'] = thisOr($data['Nome'], pkGivenLookupText($data['Bairro'], 'Eleitores', 'Bairro'));
			if(isset($data['local'])) $data['local'] = thisOr($data['secao'], pkGivenLookupText($data['local'], 'Eleitores', 'local'));

			return $data;
		},
		'Candidatos' => function($data, $options = []) {
			if(isset($data['Partido'])) $data['Partido'] = pkGivenLookupText($data['Partido'], 'Candidatos', 'Partido');
			if(isset($data['Nome'])) $data['Nome'] = pkGivenLookupText($data['Nome'], 'Candidatos', 'Nome');

			return $data;
		},
		'Colaboradores' => function($data, $options = []) {
			if(isset($data['Nome'])) $data['Nome'] = pkGivenLookupText($data['Nome'], 'Colaboradores', 'Nome');
			if(isset($data['Profissao'])) $data['Profissao'] = pkGivenLookupText($data['Profissao'], 'Colaboradores', 'Profissao');
			if(isset($data['Funcao'])) $data['Funcao'] = pkGivenLookupText($data['Funcao'], 'Colaboradores', 'Funcao');
			if(isset($data['Responsavel'])) $data['Responsavel'] = pkGivenLookupText($data['Responsavel'], 'Colaboradores', 'Responsavel');
			if(isset($data['Bairro'])) $data['Bairro'] = thisOr($data['Nome'], pkGivenLookupText($data['Bairro'], 'Colaboradores', 'Bairro'));

			return $data;
		},
		'Partidos' => function($data, $options = []) {

			return $data;
		},
		'Profissoes' => function($data, $options = []) {

			return $data;
		},
		'Funcoes' => function($data, $options = []) {

			return $data;
		},
		'Estados' => function($data, $options = []) {

			return $data;
		},
		'Municipios' => function($data, $options = []) {
			if(isset($data['Estado'])) $data['Estado'] = pkGivenLookupText($data['Estado'], 'Municipios', 'Estado');

			return $data;
		},
		'Bairro' => function($data, $options = []) {
			if(isset($data['Cidade'])) $data['Cidade'] = pkGivenLookupText($data['Cidade'], 'Bairro', 'Cidade');

			return $data;
		},
		'Zona' => function($data, $options = []) {
			if(isset($data['Estado'])) $data['Estado'] = pkGivenLookupText($data['Estado'], 'Zona', 'Estado');
			if(isset($data['Municipio'])) $data['Municipio'] = pkGivenLookupText($data['Municipio'], 'Zona', 'Municipio');

			return $data;
		},
		'Secao' => function($data, $options = []) {
			if(isset($data['Cidade'])) $data['Cidade'] = pkGivenLookupText($data['Cidade'], 'Secao', 'Cidade');
			if(isset($data['Bairro'])) $data['Bairro'] = pkGivenLookupText($data['Bairro'], 'Secao', 'Bairro');
			if(isset($data['Zona'])) $data['Zona'] = pkGivenLookupText($data['Zona'], 'Secao', 'Zona');

			return $data;
		},
		'Agenda' => function($data, $options = []) {
			if(isset($data['Responsavel'])) $data['Responsavel'] = pkGivenLookupText($data['Responsavel'], 'Agenda', 'Responsavel');
			if(isset($data['Data'])) $data['Data'] = guessMySQLDateTime($data['Data']);

			return $data;
		},
		'Atendimentos' => function($data, $options = []) {
			if(isset($data['Colaborador'])) $data['Colaborador'] = pkGivenLookupText($data['Colaborador'], 'Atendimentos', 'Colaborador');
			if(isset($data['Eleitor'])) $data['Eleitor'] = pkGivenLookupText($data['Eleitor'], 'Atendimentos', 'Eleitor');
			if(isset($data['Data'])) $data['Data'] = guessMySQLDateTime($data['Data']);

			return $data;
		},
	];

	// accept a record as an assoc array, return a boolean indicating whether to import or skip record
	$filterFunctions = [
		'Pessoas' => function($data, $options = []) { return true; },
		'Eleitores' => function($data, $options = []) { return true; },
		'Candidatos' => function($data, $options = []) { return true; },
		'Colaboradores' => function($data, $options = []) { return true; },
		'Partidos' => function($data, $options = []) { return true; },
		'Profissoes' => function($data, $options = []) { return true; },
		'Funcoes' => function($data, $options = []) { return true; },
		'Estados' => function($data, $options = []) { return true; },
		'Municipios' => function($data, $options = []) { return true; },
		'Bairro' => function($data, $options = []) { return true; },
		'Zona' => function($data, $options = []) { return true; },
		'Secao' => function($data, $options = []) { return true; },
		'Agenda' => function($data, $options = []) { return true; },
		'Atendimentos' => function($data, $options = []) { return true; },
	];

	/*
	Hook file for overwriting/amending $transformFunctions and $filterFunctions:
	hooks/import-csv.php
	If found, it's included below

	The way this works is by either completely overwriting any of the above 2 arrays,
	or, more commonly, overwriting a single function, for example:
		$transformFunctions['tablename'] = function($data, $options = []) {
			// new definition here
			// then you must return transformed data
			return $data;
		};

	Another scenario is transforming a specific field and leaving other fields to the default
	transformation. One possible way of doing this is to store the original transformation function
	in GLOBALS array, calling it inside the custom transformation function, then modifying the
	specific field:
		$GLOBALS['originalTransformationFunction'] = $transformFunctions['tablename'];
		$transformFunctions['tablename'] = function($data, $options = []) {
			$data = call_user_func_array($GLOBALS['originalTransformationFunction'], [$data, $options]);
			$data['fieldname'] = 'transformed value';
			return $data;
		};
	*/

	@include(__DIR__ . '/hooks/import-csv.php');

	$ui = new CSVImportUI($transformFunctions, $filterFunctions);
