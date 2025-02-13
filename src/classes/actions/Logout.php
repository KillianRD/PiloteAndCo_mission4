<?php

namespace iutnc\PiloteAndCo\actions;

class Logout extends Action
{

    public function execute(): string
    {
        unset($_SESSION['user']);
        $html = <<<END
            <div>
                <h1>À bientôt</h1>
                <a href='./index.php'>Revenir à l'accueil</a>
             </div>
            END;
        return $html;
    }
}