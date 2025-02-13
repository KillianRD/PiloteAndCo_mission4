<?php

namespace iutnc\PiloteAndCo\actions;

class Logout extends Action
{

    public function execute(): string
    {
        unset($_SESSION['user']);
        header('Location: index.php?action=accueil');
        exit();
    }
}