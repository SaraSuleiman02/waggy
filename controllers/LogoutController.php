<?php
session_start();

class LogoutController {
    public function logout() {
        session_destroy();
        header("Location: ../views/login.php");
        exit();
    }
}

// Example usage
$logoutController = new LogoutController();
$logoutController->logout();
?>
