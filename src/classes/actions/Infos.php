<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\actions\Action as Action;

class Infos extends Action {
    public function execute(): string {
        if (isset($_SESSION["user"]) && $this->http_method === "GET") {
            $user = unserialize($_SESSION["user"]);
            $user->id = (int)$user->id;
            $html = <<<END
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="card shadow-lg p-4 rounded">
                            <h2 class="text-center mb-4">Informations personnelles</h2>
                            <form action="index.php?action=infos" method="post">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom :</label>
                                    <input type="text" id="nom" name="nom" value="{$user->nom}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom :</label>
                                    <input type="text" id="prenom" name="prenom" value="{$user->prenom}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email :</label>
                                    <input type="email" id="email" name="email" value="{$user->mail}" class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label for="adresse" class="form-label">Adresse :</label>
                                    <input type="text" id="adresse" name="adresse" value="{$user->adresse}" class="form-control" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn green-btn-color">
                                        <i class="fa-solid fa-save"></i> Modifier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            END;
            return $html;
        } else {
            if (isset($_SESSION['user'])) {
                $user = unserialize($_SESSION['user']);

                // Sécurisation des données postées
                $nom = isset($_POST["nom"]) ? htmlspecialchars(trim($_POST["nom"])) : "";
                $prenom = isset($_POST["prenom"]) ? htmlspecialchars(trim($_POST["prenom"])) : "";
                $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : "";
                $adresse = isset($_POST["adresse"]) ? htmlspecialchars(trim($_POST["adresse"])) : "";

                // Mise à jour des informations de l'utilisateur
                $user->mettreAjour($nom, $prenom, $email, $adresse);
                $user->nom = $nom;
                $user->prenom = $prenom;
                $user->adresse = $adresse;
                $user->mail = $email;
                $user->id = (int)$user->id;

                // Mise à jour de la session
                $_SESSION['user'] = serialize($user);

                return "<div class='alert alert-success text-center mt-4'>Vos données ont été mises à jour avec succès.</div>";
            }
        }
        return "";
    }
}
