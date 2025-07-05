<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Menu';
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->label('Nama Menu')
                ->placeholder('Masukkan nama menu')
                ->required(),

            Select::make('category_id')
                ->label('Kategori Menu')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->placeholder('Pilih kategori'),

            TextInput::make('harga')
                ->label('Harga Menu')
                ->placeholder('Masukkan harga menu')
                ->numeric()
                ->required(),

            Select::make('status_menu')
                ->label('Status Ketersediaan')
                ->options([
                    'tersedia' => 'Tersedia',
                    'habis' => 'Habis',
                ])
                ->required()
                ->native(false)
                ->default('tersedia'),

            Textarea::make('deskripsi')
                ->label('Deskripsi Menu')
                ->placeholder('Masukkan deskripsi menu')
                ->nullable(),

            FileUpload::make('gambar')
                ->label('Gambar Menu')
                ->nullable()
                ->image()
                ->disk('public')
                ->directory('menu-images')
                ->maxSize(2048),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('nama')
                ->label('Nama Menu')
                ->sortable()
                ->searchable(),

            TextColumn::make('category.name')
                ->label('Kategori')
                ->sortable()
                ->searchable(),

            TextColumn::make('harga')
                ->label('Harga')
                ->money('IDR', true)
                ->sortable(),

            BadgeColumn::make('status_menu')
                ->label('Status')
                ->colors([
                    'success' => 'tersedia',
                    'danger' => 'habis',
                ])
                ->formatStateUsing(fn($state) => ucfirst($state))
                ->sortable(),

            ImageColumn::make('gambar')
                ->label('Gambar')
                ->disk('public')
                ->circular()
                ->size(50),
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
