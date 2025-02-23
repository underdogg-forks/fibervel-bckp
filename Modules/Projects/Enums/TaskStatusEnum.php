<?php

namespace Modules\Projects\Enums;

enum TaskStatusEnum: string
{
    case NOT_STARTED = 'Not Started';
    case IN_PROGRESS = 'In Progress';
    case WAITING = 'Waiting on Someone Else';
    case COMPLETED = 'Completed';
    case DEFERRED = 'Deferred';
}
