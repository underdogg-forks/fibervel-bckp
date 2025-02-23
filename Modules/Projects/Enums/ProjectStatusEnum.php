<?php

namespace Modules\Projects\Enums;

enum ProjectStatusEnum: string
{
    case PLANNED = 'Planned';
    case IN_PROGRESS = 'In Progress';
    case ON_HOLD = 'On Hold';
    case COMPLETED = 'Completed';
    case CANCELED = 'Canceled';
}
