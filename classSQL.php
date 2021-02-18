<?php

// *******************************************************
// Resolv Referencia Relacional
// *******************************************************

// Resolv Insert
include "estrutura/QInsert.php";
include "estrutura/QValue.php";

// Resolv Upadate
include "estrutura/QUpdate.php";

// Resolv Select
include "estrutura/QSelect.php";
include "estrutura/QInput.php";
include "estrutura/QWhere.php";
include "estrutura/QJoin.php";
include "estrutura/QJoinAdd.php";
include "./estrutura/QLimit.php";

// *******************************************************
// Resolv SGBD
// *******************************************************

// Resolv MySql
include "mysql/QMySQLSelect.php";
include "mysql/QMySQLInsert.php";
include "mysql/QMySQLUpdate.php";

// Resolv Sql Server
include "sqlserver/QSQLServerSelect.php";
include "sqlserver/QSQLServerInsert.php";
include "sqlserver/QSQLServerUpdate.php";

// Resolv Firebird
include "firebird/QFirebirdSelect.php";
include "firebird/QFirebirdInsert.php";
include "firebird/QFirebirdUpdate.php";

?>