<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Get;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;
use Filament\Forms\Set;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Data Pesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Form Pesanan')
                    ->columns(2)
                    ->schema([
                        TextInput::make('invoice')
                            ->required()
                            ->readOnly()
                            ->default(function () {
                                return 'INV-' . date('YmdHis');
                            }),
                        Select::make('customer_id')
                            ->label('Pelanggan')
                            ->options(Customer::all()->pluck('name', 'id'))
                            ->required()
                            ->placeholder('Pilih Pelanggan')
                            ->searchable(),
                        Select::make('product_id')
                            ->label('Produk')
                            ->options(Product::all()->pluck('name', 'id'))
                            ->required()
                            ->placeholder('Pilih Produk')
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                $set('price', Product::find($state)->price ?? 0);
                                $set('total_price', $get('quantity') * (Product::find($state)->price ?? 0));
                            }),
                        TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->readOnly()
                            ->disabled()
                            ->hidden(fn (string $operation): bool => $operation === 'edit'),
                        TextInput::make('quantity')
                            ->label('Jumlah')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, $state) {
                                $set('total_price', $state * $get('price'));
                            }),
                        TextInput::make('total_price')
                            ->label('Total Harga')
                            ->required()
                            ->readOnly(),
                        TextInput::make('province')
                            ->label('Provinsi')
                            ->required(),
                        TextInput::make('city')
                            ->label('Kota')
                            ->required(),
                        TextInput::make('address')
                            ->label('Alamat')
                            ->required(),
                        TextInput::make('more_address')
                            ->label('Detail Lainnya')
                            ->nullable(),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'process' => 'Diproses',
                                'sent' => 'Dikirim',
                                'done' => 'Selesai',
                            ])
                            ->required()
                            ->placeholder('Pilih Status'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice')
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->label('Pelanggan')
                    ->searchable(),
                TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label('Jumlah')
                    ->sortable(),
                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'process' => 'heroicon-o-arrow-path',
                        'sent' => 'heroicon-o-truck',
                        'done' => 'heroicon-o-check-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'process' => 'warning',
                        'sent' => 'info',
                        'done' => 'success',
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('address')
                    ->label('Alamat')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->form([
                        TextInput::make('province')
                            ->label('Provinsi'),
                        TextInput::make('city')
                            ->label('Kota'),
                        TextInput::make('address')
                            ->label('Alamat'),
                        TextInput::make('more_address')
                            ->label('Detail Lainnya'),
                    ])
                    ->fillForm(fn (Order $order) => [
                        'province' => $order->province,
                        'city' => $order->city,
                        'address' => $order->address,
                        'more_address' => $order->more_address,
                    ])
                    ->disabledForm()
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
