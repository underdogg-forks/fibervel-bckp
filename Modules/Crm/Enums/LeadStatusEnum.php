<?php

namespace Modules\Crm\Enums;

enum LeadStatusEnum: string
{
    case NEW = 'New';
    case CONTACTED = 'Contacted';
    case QUALIFIED = 'Qualified';
    case UNQUALIFIED = 'Unqualified';
    case CONVERTED = 'Converted';
}
