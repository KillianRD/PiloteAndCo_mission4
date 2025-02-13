<?php

namespace iutnc\PiloteAndCo\actions;

use iutnc\PiloteAndCo\actions\Action as Action;


class Infos extends Action{
    public function execute(): string{
        if(isset($_SESSION["user"])){
            $user = unserialize($_SESSION["user"]);
            $html = <<<END
                <div>
                <p>{$user->nom} {$user->prenom}</p>
                <p>{$user->mail}</p>
                <p>{$user->adresse}</p>
                </div>
            END;
            return $html;
        }
        return "";
    }
}