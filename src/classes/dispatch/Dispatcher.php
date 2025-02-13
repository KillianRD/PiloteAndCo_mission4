<?php

    namespace iutnc\PiloteAndCo\dispatch;

    use iutnc\PiloteAndCo\actions\Accueil;
    use iutnc\PiloteAndCo\actions\ParcourirCategorie;
    use iutnc\PiloteAndCo\actions\LoginAction;
    use iutnc\PiloteAndCo\actions\RegisterAction;

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
            case "electromenager":
                $a = new ParcourirCategorie("electromenager");
                $html .= $a->execute();
                break;
            case "jardinage":
                $a = new ParcourirCategorie("jardinage");
                $html .= $a->execute();
                break;
            case "literie":
                $a = new ParcourirCategorie("literie");
                $html .= $a->execute();
                break;
            case "mobilier":
                $a = new ParcourirCategorie("mobilier");
                $html .= $a->execute();
                break;
            case "home" :
            case "login" :
                $a = new LoginAction();
                break;
            case "register" :
                $a = new RegisterAction();
                break;
            default :
                $a = new Accueil();
                break;
            }
            $html .= $a->execute();
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
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="../../../css/index.css">
            </head>
            <body>
                <header style="height: 120px;">
                    <div class="bg-canary text-white d-flex justify-content-between align-items-center" style="height: 100%; padding: 0 20px;">
                        <!-- Logo à gauche -->
                        <div>
                            <a href="index.php">
                                <img src="/images/logo.png" alt="logo" style="height: 20em;">
                            </a>
                        </div>
                        <!-- Thèmes des produits au centre -->
                        <div class="d-flex justify-content-center flex-grow-1">
                            <a href="index.php?action=electromenager" class="navlink mx-4">Electroménager</a>
                            <a href="index.php?action=jardinage" class="navlink mx-4">Jardinage & bricolage</a>
                            <a href="index.php?action=literie" class="navlink mx-4">Literie</a>
                            <a href="index.php?action=jsp" class="navlink mx-4">Mobilier</a>
                        </div>
                        <!-- Connexion/inscription ou utilisateur connecté à droite -->
                        <div>
                            <!-- Section pour l'utilisateur connecté (commentée) -->
                            <!--
                            <span class="text-white">Nom d'utilisateur</span>
                            <a href="index.php&action=logout" class="btn btn-outline-light me-2">Déconnexion</a>
                            <a href="index.php&action=cart" class="btn btn-outline-light">
                                <i class="bi bi-cart"></i> <!-- Icône panier -->
                            </a>
                            <!-- Code actuel pour la connexion et l'inscription -->
                            </div class="d-flex justify-content-end align-items-center justify-content-lg-end">
                                <a href="index.php&action=login" class="navlink">Se connecter</a>
                                <p class="mx-2 mt-0 mb-0">/</p>
                                <a href="index.php&action=register" class="navlink">S'inscrire</a>
                            </div>
                        </div>
                    </div>
                </header>
            $html
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-gH0i7tq3bJwSD6GfXn985OJXmd0Y5I8au3/UoxZCGLFqGF4twkwRjSMP9QSDRNNx" crossorigin="anonymous"></script>
            </body>
        </html>
        END;
    }
}