<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\auth\Inscription;
use iutnc\PiloteAndCo\exceptions\AuthException;

class RegisterAction extends Action
{

    public function execute(): string
    {
        $html = '';
        if ($this->http_method === 'GET') {
            $html = <<<END
                <form method="post" action="?action=register" class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-lg p-4 rounded">
                                <h1 class="text-center mb-4">Inscription</h1>
                                <div class="form-group mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="date_naiss" class="form-label">Date de naissance</label>
                                    <input type="date" id="date_naiss" name="date_naiss" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Entrez votre adresse" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="code_postal" class="form-label">Code Postal</label>
                                    <input type="text" id="code_postal" name="code_postal" class="form-control" placeholder="Entrez votre code postal" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" id="ville" name="ville" class="form-control" placeholder="Entrez votre ville" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="confirm" class="form-label">Confirmer mot de passe</label>
                                    <input type="password" id="confirm" name="confirm" class="form-control" placeholder="Confirmez votre mot de passe" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn green-btn-color btn-lg">S'inscrire</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
               END;
        } else {
            $nom = filter_var($_POST['nom'], FILTER_SANITIZE_EMAIL);
            $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_EMAIL);
            $date_naiss = filter_var($_POST['date_naiss'], FILTER_SANITIZE_EMAIL);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $adresse = filter_var($_POST['adresse'], FILTER_SANITIZE_EMAIL);
            $codepostal = filter_var($_POST['code_postal'], FILTER_SANITIZE_EMAIL);
            $ville = filter_var($_POST['ville'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];

            try {
                Inscription::register($email, $password, $confirm, $nom, $prenom, $date_naiss, $adresse, $codepostal, $ville);
                $html = <<<END
                <div>
                    <p>Votre compte a été créé avec succès !</p>
                </div> 
                END;
            } catch (AuthException $e) {
                $html = <<<END
                <div>
                    <div>
                        <p>Erreur lors de la création de votre compte !</p>
                        <p>Vous possédez déja un compte ? </p>
                        <a href='?action=login'>Connexion</a></br>
                    </div> 
                    <div>
                        <p>Error: {$e->getMessage()}</p>
                    </div>       
                </div>
                END;
            }
        }
        return $html;
    }
}