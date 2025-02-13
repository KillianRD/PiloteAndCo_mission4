<?php

namespace iutnc\PiloteAndCo\actions;

class Accueil extends Actions
{
    public function execute(): string
    {
        return "
            <div>
                <h1>Bienvenue sur Pilote & Co</h1>
            </div>
        ";
    }
}