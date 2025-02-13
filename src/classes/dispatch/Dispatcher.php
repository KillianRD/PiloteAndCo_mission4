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
        $html = "";

        switch ($this->action) {
            case "home" :
            default :
                $a = new Accueil();
                $html .= $a->execute();
                break;
        }

        $this->renderPage($html);
    }

    private function renderPage(string $html): void
    {
        echo <<<END
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Réstore</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
            <body>
                <header>
                    <div class="bg-dark text-white py-2">
                        <div class="container d-flex justify-content-between align-items-center">
                            <a href="index.php"><img src="/images/logo.png" alt="logo"/></a>
                        </div>
                        <div>
                            <a href="index.php&action=login" class="btn btn-outline-light me-2">Se connecter</a>
                            <a href="index.php&action=register" class="btn btn-light">S'inscrire</a>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
                        <a href="index.php">Accueil</a>
                    </nav>
                </header>
            $html
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-gH0i7tq3bJwSD6GfXn985OJXmd0Y5I8au3/UoxZCGLFqGF4twkwRjSMP9QSDRNNx" crossorigin="anonymous"></script>
            </body>
        </html>
        END;
    }
}