<?php

declare(strict_types=1);

namespace Union\Bundle\UnionBundle\Enumeration;

enum OrderStatusEnum: string
{
    case new = 'new';
    case open = 'open';
    case closed = 'closed';
    case finished = 'finished';
}
