<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier;

interface FactoryInterface
{
    public function createFromIdentifierString(string $identifierString): ?ElementIdentifierInterface;
}
