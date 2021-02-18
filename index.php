<?php


include "PadraoObjeto.php";
include "classSQL.php";

$select = new QSelect('USUARIO', array(
	'select' => array(
		'NOME' => new QInput('NOME_USUARIO')
		, new QInput('HASH')
		, 'EMPRESA' => new QInput('NOME', array('table' => 'EMPRESA'))
	)
	, 'limit' => array(new QLimit(10))
	, 'join' => array(
		new QJoin('EMPRESA','ID_EMPRESA','ID_EMPRESA'),
		new QJoin('EMPRESA_CONTATO','ID_EMPRESA','ID_EMPRESA', array(
			'tbPrimary' => 'EMPRESA',
			'joinAdd' => array(
				new QJoinAdd('EMPRESA_CONTATO','CK_INATIVO', array('value' => 0)),
				new QJoinAdd('EMPRESA_CONTATO','ID_USUARIO', array('foreignKey' => 'ID_USUARIO')),
			)
		))
	)
	, 'where' => array(
		new QWhere(new QInput('LOGIN'), 'ADM')
		, new QWhere(new QInput('SENHA'), md5('123'), array('password' => true, 'not_number' => true))
		, new QWhere(new QInput('CNPJ', array('table'=>'EMPRESA')), '07623180000107', array('not_number' => true))
	)
));


$insert = new QInsert('USUARIO', array(
	'value' => array(
		new QValue('NOME_USUARIO','Teste'),
		new QValue('HASH', md5('ADM_123')),
		new QValue('ID_EMPRESA', 5),
		new QValue('LOGIN', 'ADM'),
		new QValue('SENHA', '123'),
	)
));

$update = new QUpdate('USUARIO', array(
	'value' => array(
		new QValue('CK_ENCERRADO',1),
		new QValue('CK_INATIVO',1),
	),
	'where' => array(
		new QWhere(new QInput('ID_USUARIO'), 1),
		// new QWhere(new QInput('LOGIN'), 'ADM'),
	)
));

?>

<script>

var select = {
	type: 'select',
	table: 'USUARIO',
	select: [
		{ type: 'input', input: 'NOME_USUARIO', as: 'NOME' },
		{ type: 'input', input: 'HASH' },
		{ type: 'input', input: 'NOME', table: 'EMPRESA', as: 'EMPRESA' }
	],
	join: [
		{ table: 'EMPRESA', id_table: 'ID_EMPRESA', foreignKey: 'ID_EMPRESA' }
	],
	where: [
		{ type: 'input', input: 'LOGIN', val: 'ADM' },
		{ type: 'input', input: 'SENHA', val: '123' },
		{ type: 'input', input: 'CNPJ', table: 'EMPRESA', val: '07623180000107', not_number: true }
	]
}

</script>

<?php

/* Output: 

	SELECT
		USUARIO.NOME_USUARIO AS NOME
		, USUARIO.HASH
		, EMPRESA.NOME AS EMPRESA
	FROM USUARIO
	INNER JOIN EMPRESA ON EMPRESA.ID_EMPRESA = USUARIO.ID_EMPRESA
	WHERE USUARIO.LOGIN = 'ADM'
	AND USUARIO.SENHA = '202cb962ac59075b964b07152d234b70'
	AND EMPRESA.CNPJ = '07623180000107';

*/
$sqlMySQL_U = new QMySQLUpdate($update);
$sqlSQLServer_U = new QSQLServerUpdate($update);
$sqlFirebird_U = new QFirebirdUpdate($update);

$sqlMySQL_I = new QMySQLInsert($insert);
$sqlSQLServer_I = new QSQLServerInsert($insert);
$sqlFirebird_I = new QFirebirdInsert($insert);

$sqlMySQL = new QMySQLSelect($select);
$sqlSQLServer = new QSQLServerSelect($select);
$sqlFirebird = new QFirebirdSelect($select);


echo 	''
		// . '<BR>'
		// . '<BR>'
		. '<H1>Update</H1>'
		. '<H2>MySQL</H2>' 			. returnSQL($sqlMySQL_U)
		. '<H2>SQL Server</H2>' 	. returnSQL($sqlSQLServer_U)
		. '<H2>Firebird</H2>' 		. returnSQL($sqlFirebird_U)

		. '<BR>'
		. '<BR>'
		. '<H1>Insert</H1>'
		. '<H2>MySQL</H2>' 			. returnSQL($sqlMySQL_I)
		. '<H2>SQL Server</H2>' 	. returnSQL($sqlSQLServer_I)
		. '<H2>Firebird</H2>' 		. returnSQL($sqlFirebird_I)

		. '<BR>'
		. '<BR>'
		. '<H1>Select</H1>'
		. '<H2>MySQL</H2>' 			. returnSQL($sqlMySQL)
		. '<H2>SQL Server</H2>' 	. returnSQL($sqlSQLServer)
		. '<H2>Firebird</H2>' 		. returnSQL($sqlFirebird);

// $sql = new QSQLServerSelect($select);
// $sql->returnSQL();
// $sql = new QFirebirdSelect($select);
// $sql->returnSQL();


function returnSQL($obj) { 
	return str_replace("\n","<br>",
			str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",
				$obj->returnSQL()
			));
}

?>