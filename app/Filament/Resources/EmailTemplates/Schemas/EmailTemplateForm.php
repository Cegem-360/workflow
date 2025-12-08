<?php

namespace App\Filament\Resources\EmailTemplates\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EmailTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Template Info')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->scopedUnique(ignoreRecord: true),
                        Toggle::make('is_active')
                            ->default(true),
                    ])
                    ->columns(3),

                Section::make('Email Content')
                    ->schema([
                        TextInput::make('subject')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Use {{variable}} for dynamic content'),
                        RichEditor::make('body_html')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Use {{variable}} placeholders for dynamic content'),
                        Textarea::make('body_text')
                            ->columnSpanFull()
                            ->helperText('Plain text version (auto-generated from HTML if empty)'),
                    ]),

                Section::make('Variables')
                    ->schema([
                        KeyValue::make('variables')
                            ->keyLabel('Variable Name')
                            ->valueLabel('Default Value')
                            ->helperText('Define variables that can be used in the template with {{variableName}} syntax'),
                    ])
                    ->collapsed(),
            ]);
    }
}
