<?php


include "PadraoObjeto.php";
include "classSQL.php";

$select = new QSelect('USUARIO', array(
	'select' => array(
		'NOME' => new QInput('NOME_USUARIO')
		, new QInput('HASH')
		, 'EMPRESA' => new QInput('NOME', array('table' => 'EMPRESA'))
	)
	, 'join' => array(
		new QJoin('EMPRESA','ID_EMPRESA','ID_EMPRESA')
	)
	, 'where' => array(
		new QWhere(new QInput('LOGIN'), 'ADM')
		, new QWhere(new QInput('SENHA'), md5('123'), array('password' => false, 'not_number' => true))
		, new QWhere(new QInput('CNPJ', array('table'=>'EMPRESA')), '07623180000107', array('not_number' => true))
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

$sql = new QMySQLSelect($select);

echo 	str_replace("\n","<br>",
		str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",
			$sql->returnSQL()
		));

// $sql = new QSQLServerSelect($select);
// $sql->returnSQL();
// $sql = new QFirebirdSelect($select);
// $sql->returnSQL();

?>