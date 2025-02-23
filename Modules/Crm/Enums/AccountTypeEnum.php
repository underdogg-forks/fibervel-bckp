<?php

namespace Modules\Crm\Enums;

enum AccountTypeEnum: string
{
    case CUSTOMER = 'Customer';
    case PARTNER = 'Partner';
    case PROSPECT = 'Prospect';
    case SUPPLIER = 'Supplier';
    case VENDOR = 'Vendor';
}
