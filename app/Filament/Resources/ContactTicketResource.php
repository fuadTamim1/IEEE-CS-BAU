<?php

namespace App\Filament\Resources;

use App\Enums\ContactTicketStatus;
use App\Filament\Resources\ContactTicketResource\Pages;
use App\Models\ContactTicket;
use App\Services\MailService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ContactTicketResource extends Resource
{
    protected static ?string $model = ContactTicket::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationLabel = 'Contact Tickets';

    protected static ?string $modelLabel = 'Contact Ticket';

    protected static ?string $pluralModelLabel = 'Contact Tickets';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('first_name')->disabled(),
            Forms\Components\TextInput::make('last_name')->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\TextInput::make('phone')->disabled(),
            Forms\Components\Textarea::make('message')->disabled()->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Name')
                    ->formatStateUsing(fn(string $state, ContactTicket $record): string => trim($record->first_name . ' ' . $record->last_name))
                    ->searchable(query: function ($query, string $search) {
                        $query->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    }),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ContactTicketStatus::tryFrom($state)?->label() ?? $state)
                    ->color(fn(string $state): string => ContactTicketStatus::tryFrom($state)?->color() ?? 'gray'),
                Tables\Columns\TextColumn::make('message')->limit(60),
                Tables\Columns\TextColumn::make('last_responded_at')->since()->toggleable(),
                Tables\Columns\TextColumn::make('created_at')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ContactTicketStatus::options()),
            ])
            ->actions([
                Tables\Actions\Action::make('details')
                    ->label('Details')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Contact Ticket Details')
                    ->slideOver()
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalContent(fn(ContactTicket $record): View => view('filament.contact-ticket-details', [
                        'ticket' => $record->load(['replies.responder']),
                    ])),
                Tables\Actions\Action::make('respond')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->visible(fn(ContactTicket $record): bool => $record->status === ContactTicketStatus::OPEN->value)
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->label('Response')
                            ->required()
                            ->rows(6)
                            ->maxLength(5000),
                    ])
                    ->action(function (ContactTicket $record, array $data): void {
                        $result = app(MailService::class)->respondToTicket(
                            $record,
                            $data['message'],
                            Auth::user()
                        );

                        Notification::make()
                            ->title($result['mail_sent'] ? 'Response sent successfully.' : 'Response saved, but email could not be sent.')
                            ->color($result['mail_sent'] ? 'success' : 'warning')
                            ->send();
                    }),
                Tables\Actions\Action::make('close')
                    ->icon('heroicon-o-lock-closed')
                    ->color('danger')
                    ->visible(fn(ContactTicket $record): bool => $record->status === ContactTicketStatus::OPEN->value)
                    ->requiresConfirmation()
                    ->action(function (ContactTicket $record): void {
                        $record->update([
                            'status' => ContactTicketStatus::CLOSED->value,
                            'closed_at' => now(),
                            'closed_by' => Auth::id(),
                        ]);

                        Notification::make()
                            ->title('Ticket closed successfully.')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('reopen')
                    ->icon('heroicon-o-lock-open')
                    ->color('warning')
                    ->visible(fn(ContactTicket $record): bool => $record->status === ContactTicketStatus::CLOSED->value)
                    ->requiresConfirmation()
                    ->action(function (ContactTicket $record): void {
                        $record->update([
                            'status' => ContactTicketStatus::OPEN->value,
                            'closed_at' => null,
                            'closed_by' => null,
                        ]);

                        Notification::make()
                            ->title('Ticket reopened successfully.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactTickets::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
