<?php

declare(strict_types=1);

namespace Union\Bundle\UnionBundle\Enumeration;

enum RequestStatusEnum: string
{
    case pending = 'pending';

    case validated = 'validated';

    case rejected = 'rejected';
}
