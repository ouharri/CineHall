<?php

class _validate
{
    static function _blob($blob): false|string
    {
        // Check if the input is not empty and has a valid size
        if (!empty($blob) && strlen($blob) <= 1000000) {
            // Remove whitespace from the beginning and end of the input
            $blob = trim($blob);
            // Return the escaped input
            return addslashes($blob);
        } else {
            // Return false if the input is invalid
            return false;
        }
    }

    static function post(): void
    {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = _validate::_string($value);
        }
    }

    public static function _string($data)
    {
        //connect to db
        $conn = mysqli_connect(HOST, USER, PASS, DBNAME);
        // Remove whitespace from the beginning and end of the input
        $data = trim($data);
        // Remove any HTML or PHP tags from the input
        $data = strip_tags($data);

        $data = addslashes($data);
        // Escape any special characters in the input
        $data = htmlspecialchars($data);
        //Escapes special characters in a string for use in an SQL statement
        $data = mysqli_real_escape_string($conn, $data);
        // Check for common SQL injection attack patterns
        $injection_patterns = array("--", ";", "\"", "'", " drop ", " union ", " select ", " update ", " delete ");
        foreach ($injection_patterns as $pattern) {
            if (stripos($data, $pattern) !== false) {
                http_response_code(405);
                echo json_encode(
                    array(
                        'message' => 'Invalid input ( not white me ! )',
                        'status' => 405
                    )
                );
                exit();
            }
        }
        return $data;
    }

    static function arr($array): void
    {
        foreach ($array as $key => $value) {
            $array[$key] = _validate::_string($value);
        }
    }
}