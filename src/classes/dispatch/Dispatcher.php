<?php

namespace iutnc\PiloteAndCo\dispatch;

class Dispatcher
{

    private ?string $action;

    public function __construct()
    {
        $this->action = $_GET['action'] ?? null;
    }

    public function run(): void
    {
        $html = "";

        switch ($this->action) {

        }

        $this->renderPage($html);
    }

    private function renderPage(string $html) : void
    {
        echo <<<END
            
            Salut, je suis la page de ecommerce de Pilote&Co
            
        END;

    }
}