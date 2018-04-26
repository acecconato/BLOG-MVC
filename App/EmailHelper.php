<?php

namespace App;

class EmailHelper extends Helper
{

    /**
     * Checks the data sent by the user when trying to send an email.
     * Return false if there is no error.
     * @param array $data
     * @return mixed
     */
    public static function formValidation(array $data)
    {
        extract($data);
        /** @var string $name */
        /** @var string $email */
        /** @var string $message */
        /** @var string $phone */

        if (!isset($name) || !isset($email) || !isset($message) || empty($name) || empty($email) || empty($message)) {
            $errors["warning"] = "Vous devez remplir les champs requis";
            return $errors;
        }

        if (strlen($name) > 50 || strlen($name) < 3) {
            $errors["warning"] = "Le nom doit faire entre 3 et 50 caractères";
        }

        if (strlen($message) > 1500 || strlen($message) < 10) {
            $errors["warning"] = "Le message doit faire entre 10 et 1500 caractères. Vous êtes actuellement à " . strlen($message) . " caractères";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["warning"] = "Merci d'entrer une adresse email valide";
        }

        if (isset($phone) && !empty($phone)) {
            if (strlen($phone) !== 10) {
                $errors["warning"] = "Le numéro de téléphone est incorrect";
            }
        }

        if (isset($errors)) {
            return $errors;
        }

        return false;
    }
}