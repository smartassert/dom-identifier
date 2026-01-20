<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier;

class Serializer implements SerializerInterface
{
    public const KEY_PARENT = 'parent';
    public const KEY_LOCATOR = 'locator';
    public const KEY_POSITION = 'position';
    public const KEY_ATTRIBUTE = 'attribute';

    /**
     * @return array<mixed>
     */
    public static function toArray(ElementIdentifierInterface $elementIdentifier): array
    {
        $parentIdentifier = $elementIdentifier->getParentIdentifier();

        $serializedParent = $parentIdentifier instanceof ElementIdentifierInterface
            ? self::toArray($parentIdentifier)
            : null;

        $data = [
            self::KEY_LOCATOR => $elementIdentifier->getLocator(),
        ];

        if (null !== $serializedParent) {
            $data[self::KEY_PARENT] = $serializedParent;
        }

        $ordinalPosition = $elementIdentifier->getOrdinalPosition();
        if (null !== $ordinalPosition) {
            $data[self::KEY_POSITION] = $ordinalPosition;
        }

        if ($elementIdentifier instanceof AttributeIdentifierInterface) {
            $data[self::KEY_ATTRIBUTE] = $elementIdentifier->getAttributeName();
        }

        return $data;
    }

    /**
     * @throws InvalidJsonException
     */
    public static function fromJson(string $json): ElementIdentifierInterface
    {
        $data = json_decode($json, true);
        if (!is_array($data)) {
            throw new InvalidJsonException($json);
        }

        $selector = $data[self::KEY_LOCATOR] ?? null;
        if (!is_string($selector)) {
            throw new InvalidJsonException($json);
        }

        $position = $data[self::KEY_POSITION] ?? null;
        if (!(null === $position || is_int($position))) {
            throw new InvalidJsonException($json);
        }

        $parent = $data[self::KEY_PARENT] ?? null;

        $parentIdentifier = is_array($parent)
            ? self::fromJson((string) json_encode($parent))
            : null;

        $attribute = $data[self::KEY_ATTRIBUTE] ?? null;

        $identifier = is_string($attribute)
            ? new AttributeIdentifier($selector, $attribute, $position)
            : new ElementIdentifier($selector, $position);

        if ($parentIdentifier instanceof ElementIdentifierInterface) {
            $identifier = $identifier->withParentIdentifier($parentIdentifier);
        }

        return $identifier;
    }
}
