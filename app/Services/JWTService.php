<?php

namespace App\Services;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use DateTimeImmutable;

class JWTService
{
    protected $config;

    public function __construct()
    {
        // Set up the JWT configuration
        $this->config = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::file(storage_path('keys/private.key')),  // Private Key
            InMemory::file(storage_path('keys/public.key'))    // Public Key
        );
    }

    /**
     * Generate JWT token
     */
    public function generateToken($userId, $roles = []): string
    {
        $now = new DateTimeImmutable();
        return $this->config->builder()
            ->issuedBy(config('app.url'))  // Issuer
            ->permittedFor(config('app.url'))  // Audience
            ->issuedAt($now)  // Time token was issued
            ->expiresAt($now->modify('+1 hour'))  // Token expires in 1 hour
            ->withClaim('uid', $userId)  // Add User ID
            ->withClaim('roles', $roles)  // Add User roles
            ->getToken($this->config->signer(), $this->config->signingKey())
            ->toString();  // Return token as string
    }

    /**
     * Validate JWT token
     */
    public function validateToken(string $token): bool
    {
        try {
            $token = $this->config->parser()->parse($token);
            $constraints = $this->config->validationConstraints();

            // Add constraint that the token must be signed correctly
            $constraints[] = new SignedWith($this->config->signer(), $this->config->verificationKey());

            return $this->config->validator()->validate($token, ...$constraints);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Decode JWT token to get claims
     */
    public function decodeToken(string $token)
    {
        try {
            $token = $this->config->parser()->parse($token);
            return $token->claims();
        } catch (\Exception $e) {
            return null;  // Return null if token is invalid
        }
    }
}
