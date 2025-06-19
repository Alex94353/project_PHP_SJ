<?php

class Validator
{
    public static function checkRequired(array $fields, array $requiredKeys)
    {
        foreach ($requiredKeys as $key) {
            if (empty($fields[$key])) {
                return false;
            }
        }
        return true;
    }

    public static function validateImage($file)
    {
        if (
            empty($file['error']) || 
            $file['error'] !== UPLOAD_ERR_OK || 
            empty($file['tmp_name']) || 
            !is_uploaded_file($file['tmp_name'])
        ) {
            return false;
        }
        return true;
    }

    public static function checkPasswordConfirmation(string $password, string $confirmation)
    {
        return $password === $confirmation;
    }
    
    public static function validateId(int $id)
    {
        return $id > 0;
    }

}
