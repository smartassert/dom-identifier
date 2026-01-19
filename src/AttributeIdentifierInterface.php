<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier;

interface AttributeIdentifierInterface extends ElementIdentifierInterface
{
    public function getAttributeName(): string;
}
