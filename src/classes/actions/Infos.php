<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\actions\Action as Action;


class Infos extends Action{
    public function execute(): string{
        if(isset($_SESSION["user"]) && $this->http_method ==="GET"){
            $user = unserialize($_SESSION["user"]);
            $user->id = (int)$user->id;
            $html = <<<END
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-lg p-4 rounded">
                            <h2 class="text-center mb-4">Informations personnelles</h2>
                            <form action="index.php?action=infos" method="post">
                                <label for="nom">Nom :</label>
                                <input type="text" id="nom" name="nom" value="{$user->nom}" required>
                                
                                <label for="prenom">Prenom :</label>
                                <input type="text" id="prenom" name="prenom" value="{$user->prenom}" required>
                                
                                <label for="email">Email :</label>
                                <input type="email" id="email" name="email" value="{$user->mail}" required>

                                <label for="adresse">Adresse :</label>
                                <input type="text" id="adresse" name="adresse" value="{$user->adresse}" required></input>

                                <button type="submit">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            END;
            return $html;
        }
        else{
            if(isset($_SESSION['user'])){
                $user = unserialize($_SESSION['user']);
                // Récupérer et sécuriser les données
                $nom = isset($_POST["nom"]) ? htmlspecialchars(trim($_POST["nom"])) : "";
                $prenom = isset($_POST["prenom"]) ? htmlspecialchars(trim($_POST["prenom"])) : "";
                $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : "";
                $adresse = isset($_POST["adresse"]) ? htmlspecialchars(trim($_POST["adresse"])) : "";
                $user->mettreAjour($nom, $prenom, $email, $adresse);
                $user->nom = $nom;
                $user->prenom = $prenom;
                $user->adresse = $adresse;
                $user->mail = $email;
                $user->id = (int)$user->id;
                unset($_SESSION['user']);
                $_SESSION['user'] = serialize($user);
                //$a = new Infos();$a->execute().
                return "<p>Vos données ont été mise à jour.</p>";
            }
        }
        return "";
    }
}