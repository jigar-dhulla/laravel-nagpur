<?php

namespace App\Filament\Pages;

use App\Models\Task;
use App\TaskStatus;
use Mokhosh\FilamentKanban\Pages\KanbanBoard as BaseKanbanBoard;

class KanbanBoard extends BaseKanbanBoard
{
    protected static string $model = Task::class;
    protected static string $statusEnum = TaskStatus::class;
}
