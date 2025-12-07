<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/config/settings.php';
if(isset($_POST['kodazavstop'])){
    try {
        $kodazavstop = intval($_POST['kodazavstop']);
        if($kodazavstop == 1969){
            $_SESSION['loggedin'] = true;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false]);
    }
}
