<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\actions\Action as Action;


class Infos extends Action{
    public function execute(): string{
        if(isset($_SESSION["user"])){
            $user = unserialize($_SESSION["user"]);
            $html = <<<END
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-lg p-4 rounded">
                            <h2 class="text-center mb-4">Informations personnelles</h2>
                            <div class="mb-3">
                                <h5 class="fw-bold">Nom et Prénom :</h5>
                                <p>{$user->nom} {$user->prenom}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="fw-bold">Email :</h5>
                                <p>{$user->mail}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="fw-bold">Adresse :</h5>
                                <p>{$user->adresse}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            END;
            return $html;
        }
        return "";
    }
}