<?php

namespace App\Filament\Pages;

use App\Events\OnTaskStatusChange;
use App\Models\Task;
use App\TaskStatus;
use Livewire\Attributes\On;
use Mokhosh\FilamentKanban\Pages\KanbanBoard as BaseKanbanBoard;

class KanbanBoard extends BaseKanbanBoard
{
    protected static string $model = Task::class;
    protected static string $statusEnum = TaskStatus::class;

    public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    {
        parent::onStatusChanged($recordId, $status, $fromOrderedIds, $toOrderedIds);
        OnTaskStatusChange::dispatch($recordId, $status, $fromOrderedIds, $toOrderedIds);
    }

    public function onSortChanged(int $recordId, string $status, array $orderedIds): void
    {
        parent::onSortChanged($recordId, $status, $orderedIds);
        OnTaskStatusChange::dispatch($recordId, $status, $orderedIds, $orderedIds);
    }

    #[On('echo:kanban-board,OnTaskStatusChange')]
    #[On('echo:kanban-board,.TaskUpdated')]
    #[On('echo:kanban-board,.TaskCreated')]
    #[On('echo:kanban-board,.TaskDeleted')]
    public function refreshBoard($event): void
    {
    }

}
