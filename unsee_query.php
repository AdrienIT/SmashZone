<?php
function unsee_query()
{
    include 'config.php';
    $query = $db->prepare("UPDATE notifications SET vu = 1 WHERE vu = 0");
    $query->execute();
    echo 'true';
}

$aResult = array();

if (!isset($_POST['functionname'])) {
    $aResult['error'] = 'No function name!';
}

if (!isset($aResult['error'])) {

    switch ($_POST['functionname']) {
        case 'unsee_query':
            $aResult['result'] = unsee_query();
            break;

        default:
            $aResult['error'] = 'Not found function ' . $_POST['functionname'] . '!';
            break;
    }
}

echo json_encode($aResult);
