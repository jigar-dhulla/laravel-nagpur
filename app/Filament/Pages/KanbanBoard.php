<?php

namespace App\Filament\Pages;

use App\Events\OnTaskStatusChange;
use App\Events\TasksPurged;
use App\Models\Task;
use App\TaskStatus;
use Filament\Actions\Action;
use Livewire\Attributes\On;
use Mokhosh\FilamentKanban\Pages\KanbanBoard as BaseKanbanBoard;

class KanbanBoard extends BaseKanbanBoard
{
    protected static string $model = Task::class;
    protected static string $statusEnum = TaskStatus::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Purge Completed Tasks')
                ->requiresConfirmation()
                ->visible(function () {
                    return auth()->user()?->can('purge-tasks');
                })
                ->action(function () {
                    Task::query()->where('status', TaskStatus::COMPLETED)->delete();
                    TasksPurged::dispatch();
                }),
        ];
    }

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
    #[On('echo-private:tasks-purged,TasksPurged')]
    public function refreshBoard($event): void
    {
    }

}
