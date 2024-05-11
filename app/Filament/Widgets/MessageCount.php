<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use Filament\Infolists\Components\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MessageCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
        Stat::make('Message count', Message::count())
            ->description('messages from users'),
        Stat::make('Project Count', Project::count())
            ->description('projects that i finished'),
        Stat::make('Skills Count', Skill::count())
            ->description('my skills'),
        ];
    }
}
