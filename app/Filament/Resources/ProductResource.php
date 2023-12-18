<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Data Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Form Produk')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Produk')
                            ->autofocus()
                            ->required()
                            ->unique(Product::class, 'name')
                            ->placeholder('Nama Produk')
                            ->live(debounce: 1000)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->unique(Product::class, 'slug')
                            ->placeholder('Slug Produk'),
                        Select::make('category_id')
                            ->label('Kategori Produk')
                            ->relationship('category', 'name')
                            ->required()
                            ->placeholder('Kategori Produk'),
                        FileUpload::make('image')
                            ->label('Gambar Produk')
                            ->image()
                            ->directory('products')
                            ->maxSize(2048)
                            ->required()
                            ->placeholder('Gambar Produk'),
                        TextInput::make('price')
                            ->label('Harga Produk')
                            ->type('number')
                            ->required()
                            ->placeholder('Harga Produk'),
                        TextInput::make('stock')
                            ->label('Stok Produk')
                            ->type('number')
                            ->required()
                            ->placeholder('Stok Produk'),
                        RichEditor::make('description')
                            ->label('Deskripsi Produk')
                            ->disableToolbarButtons(['attachFiles'])
                            ->required()
                            ->placeholder('Deskripsi Produk'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->width(100)
                    ->height(100),
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Stok')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->after(function (Product $record) {
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
