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
                <form method='post' action='?action=register'>
                    <h1>Inscription</h1>  
                    <div >
                        <input type='text' placeholder="Nom" name='nom'</input> 
                        <input type='text' placeholder="Prenom" name='prenom'</input>
                        <input type='date' placeholder="Date de naissance" name='date_naiss'</input>
                        <input type='email' placeholder="Email" name='email'</input>
                        <input type='text' placeholder="Adresse" name='adresse'</input>
                        <input type='text' placeholder="Code Postal" name='code_postal'</input>
                        <input type='text' placeholder="Ville" name='ville'</input>
                        <input type='password' placeholder="Mot de passe" name='password'</input>
                        <input type='password' placeholder="Confirmer mot de passe" name='confirm'</input>
                        <button type='submit'>S'inscrire</button>
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