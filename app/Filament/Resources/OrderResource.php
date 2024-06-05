<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Helpers\OrderHelper;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Leandrocfe\FilamentPtbrFormFields\Money;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Pedidos';

    protected static ?string $label = 'Pedido';

    protected static ?string $pluralLabel = 'Pedidos';

    protected static ?string $navigationLabel = 'Pedidos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([

                    Wizard\Step::make('Cliente/Mesa')
                    ->schema([
                        TextInput::make('order_client_name')
                            ->label('Nome do cliente')
                            ->required()
                            ->maxLength(255),                    
                    ]),
                    Wizard\Step::make('Produtos')
                    ->schema([
                        Repeater::make('order_products')
                        ->label('Produto')
                        ->schema([

                            Select::make('product_id')
                                ->label('Produto')
                                ->options(Product::all()->pluck('product_name', 'id'))
                                ->searchable(),

                            TextInput::make('order_product_quantity')
                                ->label('Quantidade')
                                ->numeric()
                                ->required()
                                ->live(onBlur: true),

                            Money::make('order_product_price')
                                ->label('Valor')
                                ->required(
                                    function(Get $get, Set $set, OrderHelper $orderHelper){                                        
                                        $set(
                                            'order_product_price',
                                            $orderHelper->calculateProductValue(
                                                (int)$get('product_id'), 
                                                (int)$get('order_product_quantity')
                                            )
                                        );                                        
                                    }
                                ),

                        ])->columns(3)
                    ]),
                    Wizard\Step::make('Pedido')
                    ->schema([
                        Select::make('order_status')
                            ->options([
                                '0' => 'Pendente',
                                '1' => 'Em preparo',
                                '2' => 'Pronto',
                                '3' => 'Finalizado',
                                '4' => 'Cancelado'
                            ])
                            ->searchable()
                            ->default('Pendente')
                            ->required(),
                        Money::make('order_discount')
                            ->label('Desconto')
                            ->required(),
                        Money::make('order_subtotal')
                            ->label('Subtotal')
                            ->required(),
                        Money::make('order_total')
                            ->label('Total')
                            ->required(),
                        Toggle::make('order_active')
                            ->label('Ativo')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->required(),  
                    ]),
                ])

                
                
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_client_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_subtotal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_active')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order_status')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
