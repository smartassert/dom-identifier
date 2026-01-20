<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier;

interface SerializerInterface
{
    /**
     * @return array<mixed>
     */
    public static function toArray(ElementIdentifierInterface $elementIdentifier): array;

    /**
     * @throws InvalidJsonException
     */
    public static function fromJson(string $json): ElementIdentifierInterface;
}
