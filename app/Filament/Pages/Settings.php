<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Card;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use App\Models\Setting;

class Settings extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament.pages.settings';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $slug = 'settings';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Settings')
                    ->description('Basic settings for your website')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->required()
                            ->maxLength(255),

                        Toggle::make('enable_registration')
                            ->label('Enable User Registration')
                            ->helperText('Allow new users to register on your site')
                            ->default(false),
                        Toggle::make('enable_sending_emails')
                            ->label('Enable Sending Emails')
                            ->default(true)
                    ]),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}
