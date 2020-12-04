<?php
session_start();
require_once('helpers/Connection.php');

$db = new Connection;

$db->query("
    SELECT STATUS_0 AS status
    FROM {$db->database()}.QRCODE 
    WHERE LABEL_0 = '{$_GET['livraison']}'
");

$results = $db->resultSet();
var_dump($results);
if (!$results) {
    $_SESSION['error'] = "Livraison {$_GET['livraison']} n'existe pas";
} else {
    $status = (int) $results[0]->status + 1;
    $db->query("
        UPDATE {$db->database()}.QRCODE 
        SET STATUS_0 = $status
        WHERE LABEL_0 = '{$_GET['livraison']}'
    ");
    if ($db->manipulation() === 'success') {
        $_SESSION['success'] = "Livraison {$_GET['livraison']} est validée $status fois";
    } else {
        $_SESSION['error'] = "Erreur de validation";
    }
}

$db->close();

header('Location: index.php', true);
