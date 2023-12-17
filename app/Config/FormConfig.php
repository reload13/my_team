<?php

namespace App\Config;

class FormConfig
{
    public static function getAttributes($formKey)
    {

        $configData = config("forms.$formKey", []);

        if ($configData === null) {
            // Return an error or false if the configuration doesn't exist
            return false; // You can customize this part based on your error handling needs
        }
        return $configData;
    }
}
