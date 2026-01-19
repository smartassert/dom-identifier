<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier;

class InvalidJsonException extends \Exception
{
    public function __construct(private string $json)
    {
        parent::__construct('Invalid json: "' . $json . '"');
    }

    public function getJson(): string
    {
        return $this->json;
    }
}
