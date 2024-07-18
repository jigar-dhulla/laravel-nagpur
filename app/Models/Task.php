<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Task extends Model implements Sortable
{
    use SortableTrait;
    use BroadcastsEvents;

    use HasFactory;

    public function broadcastOn($event)
    {
        return [
            new Channel('kanban-board'),
        ];
    }
}
