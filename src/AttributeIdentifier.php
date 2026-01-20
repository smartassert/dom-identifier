<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier;

class AttributeIdentifier extends ElementIdentifier implements AttributeIdentifierInterface
{
    public function __construct(
        string $locator,
        private string $attributeName,
        ?int $ordinalPosition = null
    ) {
        parent::__construct($locator, $ordinalPosition);
    }

    public function __toString(): string
    {
        return parent::__toString() . '.' . $this->attributeName;
    }

    public function getAttributeName(): string
    {
        return $this->attributeName;
    }

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return Serializer::toArray($this);
    }
}
