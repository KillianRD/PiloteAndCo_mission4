<?php

namespace iutnc\PiloteAndCo\auth;

use iutnc\PiloteAndCo\db\ConnectionFactory;
use iutnc\PiloteAndCo\exceptions\AuthException;
use iutnc\PiloteAndCo\models\Utilisateur;
use PDO;
class Authentification
{
    public static function authenticate(string $mail, string $password) : void
    {
        $db = ConnectionFactory::makeConnection();
        $requete = $db->prepare("SELECT mdp FROM utilisateur WHERE mail = ?");
        $requete->bindParam(1, $mail);
        $requete->execute();

        $hashpass = $requete->fetch(PDO::FETCH_ASSOC);
        if (!password_verify($password, $hashpass['mdp'])) {
            throw new AuthException("Problème lors de la connection au compte");
        } else {
            Authentification::loadProfile($mail);
        }
    }

    public static function loadProfile(string $mail) : void
    {
        $db = ConnectionFactory::makeConnection();
        $requete = $db->prepare("SELECT * FROM utilisateur WHERE mail = ?");
        $requete->bindParam(1, $mail);
        $requete->execute();
        $infoUser = $requete->fetch(PDO::FETCH_ASSOC);

        $user = new Utilisateur($infoUser['id_utilisateur'] ,$infoUser['nom'], $infoUser['prenom'], $infoUser['mail'], $infoUser['mdp'], $infoUser['date_naiss'], $infoUser['adresse'], $infoUser['code_postal'], $infoUser['ville'], $infoUser['isadmin']);
        $_SESSION['user'] = serialize($user);
    }

}