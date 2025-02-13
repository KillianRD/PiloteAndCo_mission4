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
                    <div class="top-bar">
                        <div class="logo">
                            <a href="index.php"><img src="test.png" alt="logo"/></a>
                        </div>
                        <div class="auth">
                            <a href="index.php&action=login">Login</a>
                        </div>
                    </div>
                    <nav class="nav-bar">
                        <a href="index.php">Accueil</a>
                    </nav>
                </header>
        END
            . $html .
            <<<END
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-gH0i7tq3bJwSD6GfXn985OJXmd0Y5I8au3/UoxZCGLFqGF4twkwRjSMP9QSDRNNx" crossorigin="anonymous"></script>
            </body>
        </html>
        END;
    }
}