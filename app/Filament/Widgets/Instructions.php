<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class Instructions extends Widget
{
    protected static string $view = 'filament.widgets.instructions';
    protected int | string | array $columnSpan = 'full';
}
