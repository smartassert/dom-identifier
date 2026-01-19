<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier;

class AttributeIdentifier extends ElementIdentifier implements AttributeIdentifierInterface
{
    private string $attributeName = '';

    public function __construct(string $locator, string $attributeName, ?int $ordinalPosition = null)
    {
        parent::__construct($locator, $ordinalPosition);

        $this->attributeName = $attributeName;
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
