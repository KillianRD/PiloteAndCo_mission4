<?php

namespace iutnc\PiloteAndCo\dispatch;

use iutnc\PiloteAndCo\actions\Accueil;

class Dispatcher
{

    private ?string $action;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? null;
    }

    public function run(): void
    {
        $html = (new Accueil())->execute();

        switch ($this->action) {
            case "accueil":
                $html = (new Accueil())->execute();
                break;
        }

        $this->renderPage($html);
    }

    private function renderPage(string $html) : void
    {
        echo <<<END
                $html
            END;

    }
}