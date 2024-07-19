<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ActiveUsers extends Widget
{
    public array $users = [];

    protected static string $view = 'filament.widgets.active-users';
}
