<?php

declare(strict_types=1);

namespace SmartAssert\DomIdentifier\Enum;

enum Type: string
{
    case CSS = 'css';
    case XPATH = 'xpath';
}
