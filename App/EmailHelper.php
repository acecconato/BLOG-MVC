<?php

namespace App;

class EmailHelper
{
    /**
     * Returns errors encoutered during the verification.
     * Return false if there is no error.
     * @param array $data
     * @return bool
     */
    public static function formValidation(array $data)
    {
        extract($data);

        if(isset($name) && isset($email) && isset($message) && !empty($name) && !empty($email) && !empty($name)) {
            if(strlen($name) > 50) {
                $errors["warning"] = "Nom trop long. (50 caractères maximum)";
            } elseif(strlen($name) < 3) {
                $errors["warning"] = "Nom trop court. (3 caractères minimum)";
            }

            if(strlen($message) > 1500) {
                $errors["warning"] = "Message trop long. (1500 caractères max)";
            } elseif(strlen($message) < 10) {
                $errors["warning"] = "Message trop court. (10 caractères minimum)";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["warning"] = "L'adresse email est invalide";
            }

            if(isset($phone) && !empty($phone)) {
                if(strlen($phone) !== 10) {
                    $errors["warning"] = "Le numéro de téléphone est incorrect";
                }
            }

        } else {
            $errors["warning"] = "Vous devez remplir les champs requis";
        }

        if(isset($errors)) {
            return $errors;
        }

        return false;
    }
}