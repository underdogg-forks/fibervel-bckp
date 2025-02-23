<?php

namespace Modules\Crm\Enums;

enum ContactTypeEnum: string
{
    case DECISION_MAKER = 'Decision Maker';
    case INFLUENCER = 'Influencer';
    case TECHNICAL_CONTACT = 'Technical Contact';
    case BILLING_CONTACT = 'Billing Contact';
    case SUPPORT_CONTACT = 'Support Contact';
}
