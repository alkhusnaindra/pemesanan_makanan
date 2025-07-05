<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('meja_id')
                ->label('Nomor Meja')
                ->relationship('meja', 'nomor_meja')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('total_harga')
                ->label('Total Harga')
                ->numeric()
                ->default(0)
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Status Pesanan')
                ->options([
                    'menunggu' => 'Menunggu',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                ])
                ->default('menunggu')
                ->required(),

            Forms\Components\Select::make('status_pembayaran')
                ->label('Status Pembayaran')
                ->options([
                    'belum' => 'Belum Dibayar',
                    'sudah' => 'Sudah Dibayar',
                ])
                ->default('belum')
                ->required(),

            Forms\Components\Select::make('metode_pembayaran')
                ->label('Metode Pembayaran')
                ->options([
                    'offline' => 'offline',
                    'qris' => 'QRIS',
                    'transfer' => 'Transfer',
                ])
                ->nullable(),

            Forms\Components\TextInput::make('order_id')
                ->label('Order ID')
                ->nullable(),

            Forms\Components\TextInput::make('snap_token')
                ->label('Snap Token')
                ->nullable(),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('meja.nomor_meja')->label('Nomor Meja'),
                Tables\Columns\TextColumn::make('total_harga')->label('Total Harga'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('status_pembayaran')->label('Status Pembayaran'),
                Tables\Columns\TextColumn::make('metode_pembayaran')->label('Metode Pembayaran'),
                Tables\Columns\TextColumn::make('order_id')->label('Order ID'),
                Tables\Columns\TextColumn::make('snap_token')->label('Snap Token'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Pesanan'),
                
            ])
            ->filters([
                // Filter tanggal menggunakan DatePicker
                Filter::make('tanggal')
                    ->form([
                        DatePicker::make('tanggal')->label('Filter Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $data['tanggal']
                            ? $query->whereDate('created_at', $data['tanggal'])
                            : $query;
                    }),

                // Filter untuk pesanan hari ini
                Filter::make('hari_ini')
                    ->label('Pesanan Hari Ini')
                    ->query(fn (Builder $query) => $query->whereDate('created_at', now()->toDateString())),
            ])
                
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
