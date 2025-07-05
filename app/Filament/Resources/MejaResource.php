<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MejaResource\Pages;
use App\Filament\Resources\MejaResource\RelationManagers;
use App\Models\Meja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MejaResource extends Resource
{
    protected static ?string $model = Meja::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Meja';

    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nomor_meja')
                    ->label('Nomor Meja')
                    ->placeholder('Contoh: 01')
                    ->prefix('meja-')
                    ->hint('Masukkan nomor meja disini')
                    ->required(),

                Forms\Components\TextInput::make('qr_code_url')
                    ->label('URL QR Code')
                    ->disabled()
                    ->hint('URL QR Code akan terisi otomatis setelah meja dibuat')
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_meja')->label('Nomor Meja'),
                ImageColumn::make('qr_code_url')->label('QR Code'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make('download_qr')
                    ->label('Download QR Code')
                    ->url(fn(Meja $meja) => $meja->qr_code_url)
                    ->openUrlInNewTab(),

                DeleteAction::make(),
                // Tables\Actions\ViewAction::make('delete')
                // ->label('Delete')
                // ->action(function () {
                //     $this->record->delete();
                //     return redirect()->route('filament.resources.meja.index');
                // })
                // ->color('danger')
                // ->icon('heroicon-o-trash')
                // ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMejas::route('/'),
            'create' => Pages\CreateMeja::route('/create'),
            'edit' => Pages\EditMeja::route('/{record}/edit'),
        ];
    }
}
