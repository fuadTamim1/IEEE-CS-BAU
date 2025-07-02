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
                        TextInput::make('site_name')->label('Site Name')->required()->maxLength(255),
                        TextInput::make('site_logo')->label('Site Logo / Favicon')->helperText('Upload path or URL'),
                        TextInput::make('site_tagline')->label('Tagline / Mission'),
                        TextInput::make('default_language')->label('Default Language')->default('en'),
                        TextInput::make('timezone')->label('Timezone')->default('Asia/Amman'),
                        TextInput::make('theme')->label('Theme')->default('auto'),
                        Toggle::make('enable_maintenance_mode')->label('Enable Maintenance Mode'),
                    ]),
                Section::make('Homepage & UI Settings')
                    ->schema([
                        Toggle::make('show_hero_section')->label('Show Hero Section'),
                        TextInput::make('featured_posts_count')->label('Featured Posts Count'),
                        TextInput::make('events_to_display')->label('Events to Display'),
                        TextInput::make('custom_footer_text')->label('Custom Footer Text'),
                        Toggle::make('show_team_section')->label('Show Team Section'),
                    ]),
                Section::make('Contact & Social')
                    ->schema([
                        TextInput::make('contact_email')->label('Contact Email'),
                        TextInput::make('whatsapp_support_number')->label('WhatsApp Support Number'),
                        TextInput::make('facebook_page')->label('Facebook Page'),
                        TextInput::make('linkedin_page')->label('LinkedIn Page'),
                        TextInput::make('google_map_location')->label('Google Map Location'),
                    ]),
                Section::make('Admin & User Roles')
                    ->schema([
                        Toggle::make('registration_open')->label('Registration Open'),
                        TextInput::make('default_role_on_signup')->label('Default Role on Signup'),
                        Toggle::make('admin_approval_required')->label('Admin Approval Required'),
                        Toggle::make('enable_email_verification')->label('Enable Email Verification'),
                    ]),
                Section::make('Security')
                    ->schema([
                        Toggle::make('two_factor_auth_enabled')->label('Two-Factor Auth Enabled'),
                        TextInput::make('password_expiration_days')->label('Password Expiration Days'),
                        TextInput::make('login_attempt_limit')->label('Login Attempt Limit'),
                        TextInput::make('allowed_domains_for_registration')->label('Allowed Domains for Registration'),
                    ]),
                Section::make('Blog & Content')
                    ->schema([
                        TextInput::make('posts_per_page')->label('Posts Per Page'),
                        Toggle::make('allow_guest_comments')->label('Allow Guest Comments'),
                        Toggle::make('require_admin_review_before_publish')->label('Require Admin Review Before Publish'),
                        Toggle::make('enable_markdown_editor')->label('Enable Markdown Editor'),
                    ]),
                Section::make('Leaderboard / Gamification')
                    ->schema([
                        Toggle::make('enable_leaderboard')->label('Enable Leaderboard'),
                        TextInput::make('top_n_weekly_members')->label('Top N Weekly Members'),
                        Toggle::make('points_system_enabled')->label('Points System Enabled'),
                        TextInput::make('points_per_post')->label('Points per Post'),
                        TextInput::make('points_per_event')->label('Points per Event'),
                        TextInput::make('points_per_comment')->label('Points per Comment'),
                    ]),
                Section::make('Events & Calendar')
                    ->schema([
                        TextInput::make('default_event_duration')->label('Default Event Duration'),
                        Toggle::make('show_past_events')->label('Show Past Events'),
                        Toggle::make('allow_rsvp')->label('Allow RSVP'),
                        TextInput::make('rsvp_deadline_before_event')->label('RSVP Deadline Before Event'),
                    ]),
                Section::make('DevOps / Integration')
                    ->schema([
                        Toggle::make('enable_github_webhooks')->label('Enable GitHub Webhooks'),
                        TextInput::make('google_analytics_id')->label('Google Analytics ID'),
                        TextInput::make('discord_webhook_for_new_posts')->label('Discord Webhook for New Posts'),
                        TextInput::make('api_rate_limit')->label('API Rate Limit'),
                    ]),
                Section::make('Bonus / Advanced')
                    ->schema([
                        Toggle::make('dark_mode_toggle_per_user')->label('Dark Mode Toggle per user'),
                        Toggle::make('dynamic_banner_alerts')->label('Dynamic Banner Alerts'),
                        TextInput::make('custom_home_sections_ordering')->label('Custom Home Sections Ordering'),
                        TextInput::make('feature_flags')->label('Feature Flags'),
                        TextInput::make('file_upload_size_limit')->label('File Upload Size Limit'),
                    ]),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            // Prevent null values for 'value' column
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}
