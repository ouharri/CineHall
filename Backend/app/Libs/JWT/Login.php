<?php

class Login
{
    public static function JWT(): void
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header("Access-Control-Allow-Headers:  Content-Type, Authorization, X-Auth-Token, Origin ");
        header("Access-Control-Allow-Methods: *");
        http_response_code(200);

        // On vérifie si on reçoit un token
        if (isset($_SERVER['Authorization'])) {
            $token = trim($_SERVER['Authorization']);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $token = trim($_SERVER['HTTP_AUTHORIZATION']);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            if (isset($requestHeaders['Authorization'])) {
                $token = trim($requestHeaders['Authorization']);
            }
        }

        // On vérifie si la chaine commence par "Bearer "
        if (!isset($token) || !preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            http_response_code(200);
            echo json_encode(['message' => 'Token introuvable']);
            exit;
        }

        // On extrait le token
        $token = str_replace('Bearer ', '', $token);

        $jwt = new JWT();

        // On vérifie la validité
        if (!$jwt->isValid($token)) {
            http_response_code(400);
            echo json_encode(['message' => 'Token invalide']);
            exit;
        }

        // On vérifie la signature
        if (!$jwt->check($token, SECRET)) {
            http_response_code(403);
            echo json_encode(['message' => 'Le token est invalide']);
            exit;
        }

        // On vérifie l'expiration
        if ($jwt->isExpired($token)) {
            http_response_code(403);
            echo json_encode(['message' => 'Le token a expiré']);
            exit;
        }

//        echo json_encode($jwt->getPayload($token));
//        return $token;
    }
}