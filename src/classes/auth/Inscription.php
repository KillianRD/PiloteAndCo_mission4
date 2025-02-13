<?php

namespace iutnc\PiloteAndCo\auth;

use iutnc\PiloteAndCo\db\ConnectionFactory;
use iutnc\PiloteAndCo\exceptions\AuthException;
use PDO;

class Inscription
{
    public static function register(string $mail, string $mdp, string $confirmMdp, string $nom, string $prenom, string $date_naiss, string $adresse, string $code_postal, string $ville): void
    {
        $db = ConnectionFactory::makeConnection();
        $verifDupEmail = $db->prepare("SELECT mail FROM utilisateur WHERE mail = ?");
        $verifDupEmail->bindParam(1, $mail);
        $verifDupEmail->execute();

        if (($verifDupEmail->fetch(PDO::FETCH_ASSOC) === false) && self::checkPassStrength($mdp) && ($mdp === $confirmMdp)) {
            $hashpass = password_hash($mdp, PASSWORD_DEFAULT, ['cost' => 12]);
            $insert = $db->prepare("INSERT INTO utilisateur (`mail`, `mdp`, `nom`, `prenom`, `date_naiss`, `adresse`, `code_postal`, `ville`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bindParam(1, $mail);
            $insert->bindParam(2, $hashpass);
            $insert->bindParam(3, $nom);
            $insert->bindParam(4, $prenom);
            $insert->bindParam(5, $date_naiss);
            $insert->bindParam(6, $adresse);
            $insert->bindParam(7, $code_postal);
            $insert->bindParam(8, $ville);

            $insert->execute();
            Authentification::loadProfile($mail);
        } else {
            throw new AuthException("Problème lors de l'inscription");
        }
    }

    private static function checkPassStrength(string $pass, int $min = 6): bool
    {
        $length = (strlen($pass) >= $min);
        $digit = preg_match("#[\d]#", $pass);
        $special = preg_match("#[\W]#", $pass);
        $lower = preg_match("#[a-z]#", $pass);
        $upper = preg_match("#[A-Z]#", $pass);

        if (!$length || !$digit || !$special || !$lower || !$upper) return false;
        return true;
    }
}