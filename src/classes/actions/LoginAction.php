<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\auth\Authentification;
use iutnc\PiloteAndCo\exceptions\AuthException;

class LoginAction extends Action
{

    public function execute(): string
    {
        $html = '';
        if ($this->http_method === 'GET') {
            $html = <<<END
                <form method='post' action='?action=login'> 
                        <h1><img src="/images/logo.png" alt="Logo">Bienvenue sur Réstore</h1>
                        <div>
                            <input type='text' placeholder="Email" name='mail'>
                            <input type='password' placeholder="Mot de passe" name='mdp'>
                            <button type='submit' >Se connecter</button>
                            <p>______________________________________________</p>
                            <a href='?action=register'>Créer un compte</a>
                        </div>
                </form>
            END;
        } else {
            $email = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['mdp'];
            try {
                Authentification::authenticate($email, $password);
                $user = unserialize($_SESSION['user']);
                $html = <<<END
                <div>
                    <h1>Bienvenue {$user->prenom}</h1>
                    <a href='?action=logout'>Se déconnecter</a>
                </div> 
                END;
            } catch (AuthException $e) {
                $html = <<<END
                    <div>
                        <div>
                            <p>Erreur lors de la connexion à votre compte !</p>
                            <p>Vous n'avez pas encore de compte ?</p>
                            <a href='?action=register'>S'inscrire</a>
                        </div>
                    </div>
                END;
            }
        }
        return $html;
    }
}