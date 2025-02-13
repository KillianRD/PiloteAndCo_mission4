<?php

namespace iutnc\PiloteAndCo\actions;

class Logout extends Action
{

    public function execute(): string
    {
        if ($this->http_method === 'GET') {
            $html = <<<END
                <form method='post' action='?action=logout'>
                <button type='submit'>Se déconnecter</button><br><br>
                </form>
            END;
        } else {
            unset($_SESSION['user']);
            $html = <<<END
            <div>
                <h1>À bientôt</h1>
                <a href='#'>Revenir à l'accueil</a>
             </div>
            END;
        }
        return $html;
    }
}