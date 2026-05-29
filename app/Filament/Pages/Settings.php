<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Support\AdminRoles;
use App\Support\SettingCatalog;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function canAccess(): bool
    {
        return Auth::user()?->hasAnyRole(AdminRoles::superAdminRoles()) ?? false;
    }

    public function mount(): void
    {
        $this->form->fill($this->buildFormState());
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
                        TextInput::make('site_logo')
                            ->label('Site Logo')
                            ->maxLength(255)
                            ->helperText('Upload path or absolute URL.'),
                        TextInput::make('site_favicon')
                            ->label('Site Favicon')
                            ->maxLength(255)
                            ->helperText('Upload path or absolute URL.'),
                        TextInput::make('site_tagline')
                            ->label('Tagline / Mission')
                            ->maxLength(255),
                        TextInput::make('default_language')
                            ->label('Default Language')
                            ->required()
                            ->maxLength(10),
                        TextInput::make('timezone')
                            ->label('Timezone')
                            ->required()
                            ->maxLength(64),
                        TextInput::make('theme')
                            ->label('Theme')
                            ->maxLength(20),
                        Toggle::make('enable_maintenance_mode')->label('Enable Maintenance Mode'),
                    ]),
                Section::make('Homepage & UI Settings')
                    ->schema([
                        Toggle::make('show_hero_section')->label('Show Hero Section'),
                        TextInput::make('featured_posts_count')
                            ->label('Featured Posts Count')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->maxValue(30),
                        TextInput::make('events_to_display')
                            ->label('Events to Display')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->maxValue(30),
                        TextInput::make('custom_footer_text')
                            ->label('Custom Footer Text')
                            ->maxLength(255),
                        Toggle::make('show_team_section')->label('Show Team Section'),
                        Toggle::make('show_only_team_admins')->label('Show Only Team Admins'),
                        Toggle::make('enable_preloader')->label('Enable Preloader'),
                    ]),
                Section::make('Contact & Social')
                    ->schema([
                        Toggle::make('enable_contact_form')
                            ->label('Enable Contact Form')
                            ->default(true)
                            ->helperText('Disable to hide contact forms across public pages.'),
                        TextInput::make('contact_email')
                            ->label('Contact Email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('whatsapp_support_number')
                            ->label('WhatsApp Support Number')
                            ->maxLength(50),
                        TextInput::make('facebook_page')
                            ->label('Facebook Page')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('linkedin_page')
                            ->label('LinkedIn Page')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('google_map_location')
                            ->label('Google Map Location')
                            ->url()
                            ->maxLength(500),
                        Toggle::make('enable_sending_emails')->label('Enable Sending Emails'),
                    ]),
                Section::make('Admin & User Roles')
                    ->schema([
                        Toggle::make('registration_open')->label('Registration Open'),
                        Toggle::make('enable_login')->label('Enable Login'),
                        Toggle::make('enable_registration')->label('Enable Registration'),
                        TextInput::make('default_role_on_signup')
                            ->label('Default Role on Signup')
                            ->required()
                            ->maxLength(50),
                        Toggle::make('admin_approval_required')->label('Admin Approval Required'),
                        Toggle::make('enable_email_verification')->label('Enable Email Verification'),
                    ]),
                Section::make('Security')
                    ->schema([
                        Toggle::make('two_factor_auth_enabled')->label('Two-Factor Auth Enabled'),
                        TextInput::make('password_expiration_days')
                            ->label('Password Expiration Days')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(3650),
                        TextInput::make('login_attempt_limit')
                            ->label('Login Attempt Limit')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->maxValue(20),
                        TextInput::make('allowed_domains_for_registration')
                            ->label('Allowed Domains for Registration')
                            ->maxLength(255)
                            ->helperText('Comma-separated domains like @ieee.org,@bau.edu.jo.'),
                    ]),
                Section::make('Blog & Content')
                    ->schema([
                        TextInput::make('posts_per_page')
                            ->label('Posts Per Page')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->maxValue(100),
                        Toggle::make('allow_guest_comments')->label('Allow Guest Comments'),
                        Toggle::make('require_admin_review_before_publish')->label('Require Admin Review Before Publish'),
                        Toggle::make('enable_markdown_editor')->label('Enable Markdown Editor'),
                    ]),
                Section::make('Leaderboard / Gamification')
                    ->schema([
                        Toggle::make('enable_leaderboard')->label('Enable Leaderboard'),
                        TextInput::make('top_n_weekly_members')
                            ->label('Top N Weekly Members')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->maxValue(10),
                        Toggle::make('points_system_enabled')->label('Points System Enabled'),
                        TextInput::make('points_per_post')
                            ->label('Points per Post')
                            ->numeric()
                            ->integer()
                            ->minValue(0),
                        TextInput::make('points_per_event')
                            ->label('Points per Event')
                            ->numeric()
                            ->integer()
                            ->minValue(0),
                        TextInput::make('points_per_comment')
                            ->label('Points per Comment')
                            ->numeric()
                            ->integer()
                            ->minValue(0),
                    ]),
                Section::make('Events & Calendar')
                    ->schema([
                        TextInput::make('default_event_duration')
                            ->label('Default Event Duration (minutes)')
                            ->numeric()
                            ->integer()
                            ->minValue(15)
                            ->maxValue(1440),
                        Toggle::make('show_past_events')->label('Show Past Events'),
                        Toggle::make('allow_rsvp')->label('Allow RSVP'),
                        TextInput::make('rsvp_deadline_before_event')
                            ->label('RSVP Deadline Before Event (hours)')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(720),
                    ]),
                Section::make('DevOps / Integration')
                    ->schema([
                        Toggle::make('enable_github_webhooks')->label('Enable GitHub Webhooks'),
                        TextInput::make('google_analytics_id')
                            ->label('Google Analytics ID')
                            ->maxLength(50),
                        TextInput::make('discord_webhook_for_new_posts')
                            ->label('Discord Webhook for New Posts')
                            ->url()
                            ->maxLength(500),
                        TextInput::make('api_rate_limit')
                            ->label('API Rate Limit')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->maxValue(10000),
                    ]),
                Section::make('Bonus / Advanced')
                    ->schema([
                        Toggle::make('dark_mode_toggle_per_user')->label('Dark Mode Toggle per user'),
                        Toggle::make('dynamic_banner_alerts')->label('Dynamic Banner Alerts'),
                        TextInput::make('custom_home_sections_ordering')
                            ->label('Custom Home Sections Ordering')
                            ->maxLength(255),
                        TextInput::make('feature_flags')
                            ->label('Feature Flags')
                            ->maxLength(5000),
                        TextInput::make('file_upload_size_limit')
                            ->label('File Upload Size Limit (KB)')
                            ->numeric()
                            ->integer()
                            ->minValue(128)
                            ->maxValue(1024 * 100)
                            ->helperText('Used by admin import/upload limits. Example: 10240 = 10 MB.'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $normalizedState = $this->normalizedStateForSave($this->form->getState());

        DB::transaction(function () use ($normalizedState): void {
            foreach ($normalizedState as $key => $value) {
                Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
            }
        });

        $this->form->fill($this->buildFormState());

        Notification::make()
            ->title('Settings saved successfully')
            ->body('All values were validated and normalized before persistence.')
            ->success()
            ->send();
    }

    /**
     * @return array<string, mixed>
     */
    private function buildFormState(): array
    {
        $storedSettings = Setting::query()->pluck('value', 'key')->toArray();
        $state = [];

        foreach (SettingCatalog::keys() as $key) {
            $state[$key] = SettingCatalog::cast($key, $storedSettings[$key] ?? null);
        }

        return $state;
    }

    /**
     * @param  array<string, mixed>  $state
     * @return array<string, string>
     */
    private function normalizedStateForSave(array $state): array
    {
        $normalized = [];

        foreach (SettingCatalog::keys() as $key) {
            $normalized[$key] = SettingCatalog::normalizeForStorage(
                $key,
                $state[$key] ?? SettingCatalog::default($key),
            );
        }

        return $normalized;
    }
}
