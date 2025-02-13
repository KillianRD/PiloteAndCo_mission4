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
            <form method="post" action="?action=login" class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-lg p-4 rounded">
                            <h1 class="text-center mb-4">Bienvenue sur Réstore</h1>
                            <div class="form-group mb-3">
                                <label for="mail" class="form-label">Email</label>
                                <input type="text" id="mail" name="mail" class="form-control" placeholder="Entrez votre email" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="mdp" class="form-label">Mot de passe</label>
                                <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Entrez votre mot de passe" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn green-btn-color btn-lg">Se connecter</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="?action=register" class="text-decoration-none">Créer un compte</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            END;
        } else {
            $email = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['mdp'];
            try {
                Authentification::authenticate($email, $password);
                $user = unserialize($_SESSION['user']);
                header('Location: index.php?action=accueil');
                exit();
            } catch (AuthException $e) {
                $html = <<<END
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4">
                            <div class="alert alert-danger text-center" role="alert">
                                <h4 class="alert-heading">Erreur</h4>
                                <p>Erreur lors de la connexion à votre compte !</p>
                                <p>Vous n'avez pas encore de compte ?</p>
                                <a href="?action=register" class="btn green-btn-color">S'inscrire</a>
                            </div>
                        </div>
                    </div>
                </div>
                END;
            }
        }
        return $html;
    }
}