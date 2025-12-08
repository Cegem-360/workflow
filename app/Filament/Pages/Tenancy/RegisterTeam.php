<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register team';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        $team = Team::create([
            ...$data,
            'owner_id' => Auth::id(),
        ]);

        $team->members()->attach(Auth::user(), ['role' => 'owner']);

        return $team;
    }
}
