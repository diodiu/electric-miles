<?php

namespace App\Models;

enum StatusEnum: string
{
    case NEW = 'new';
    case DELAYED = 'delayed';
    case DONE = 'done';
}
