<?php


class JWT
{
    /**
     * Génération JWT
     * @param array $header Header du token
     * @param array $payload Payload du Token
     * @param string $secret Clé secrète
     * @param int $validity Durée de validité (en secondes)
     * @return string Token
     */
    public function generate(array $header, array $payload, string $secret, int $validity = 86400): string
    {
        if ($validity > 0) {
            $now = new DateTime();
            $expiration = $now->getTimestamp() + $validity;
            $payload['iat'] = $now->getTimestamp();
            $payload['exp'] = $expiration;
        }

        // On encode en base64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        // On "nettoie" les valeurs encodées
        // On retire les +, / et =
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        // On génère la signature
        $secret = base64_encode($secret);
        $signature = hash_hmac('sha256', $base64Header . '.' . $base64Payload, $secret, true);

        $base64Signature = base64_encode($signature);

        $signature = str_replace(['+', '/', '='], ['-', '_', ''], $base64Signature);

        // On crée le token
        return $base64Header . '.' . $base64Payload . '.' . $signature;
    }

    /**
     * Vérification du token
     * @param string $token Token à vérifier
     * @param string $secret Clé secrète
     * @return bool Vérifié ou non
     */
    public function check(string $token, string $secret): bool
    {
        // On récupère le header et le payload
        $header = $this->getHeader($token);
        $payload = $this->getPayload($token);

        // On génère un token de vérification
        $verifToken = $this->generate($header, $payload, $secret, 0);

        return $token === $verifToken;
    }

    /**
     * Récupère le header
     * @param string $token Token
     * @return array Header
     */
    public function getHeader(string $token): array
    {
        // Démontage token
        $array = explode('.', $token);

        // On décode le header
        return json_decode(base64_decode($array[0]), true);
    }

    /**
     * Retourne le payload
     * @param string $token Token
     * @return array Payload
     */
    public function getPayload(string $token): array
    {
        // Démontage token
        $array = explode('.', $token);

        // On décode le payload
        return json_decode(base64_decode($array[1]), true);
    }

    /**
     * Vérification de l'expiration
     * @param string $token Token à vérifier
     * @return bool Vérifié ou non
     */
    public function isExpired(string $token): bool
    {
        $payload = $this->getPayload($token);

        $now = new DateTime();

        return $payload['exp'] < $now->getTimestamp();
    }

    /**
     * Vérification de la validité du token
     * @param string $token Token à vérifier
     * @return bool Vérifié ou non
     */
    public function isValid(string $token): bool
    {
        return preg_match(
                '/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/',
                $token
            ) === 1;
    }
}