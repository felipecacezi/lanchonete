<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Item;
use App\Models\Product;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Leandrocfe\FilamentPtbrFormFields\Money;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Repeater;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Cadastros';

    protected static ?string $label = 'Produto';

    protected static ?string $pluralLabel = 'Produtos';

    protected static ?string $navigationLabel = 'Produtos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make([
                    Step::make('Produto')
                        ->schema([
                            Select::make('category_id')
                                ->label('Categoria')
                                ->options(Category::all()->pluck('cat_name', 'id'))
                                ->searchable(),
                            Forms\Components\TextInput::make('product_name')
                                ->required()
                                ->label('Nome')
                                ->maxLength(100),
                            Forms\Components\TextInput::make('product_code')
                                ->required()
                                ->label('Codigo')
                                ->maxLength(4),
                            RichEditor::make('product_description')->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])->label('Descricao'),
                            RichEditor::make('product_obs')->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])->label('Observacoes'),
                            Money::make('product_price')
                                ->label('Preco')
                                ->required(),
                            Forms\Components\FileUpload::make('product_image')
                                ->label('Imagem')
                                ->disk('public')
                                ->directory('/public/products')
                                ->previewable(true)
                                ->image(),
                            Toggle::make('product_active')
                                ->label('Ativo')
                                ->onColor('success')
                                ->offColor('danger')
                                ->default(true)
                                ->required(),
                        ]),
                    Step::make('Itens')
                        ->schema([                                
                            Repeater::make('itemsProduct')
                                ->relationship()
                                ->schema([
                                    Select::make('item_id')
                                        ->label('Item')
                                        ->options(Item::all()->pluck('item_name', 'id'))
                                        ->searchable(),
                                    Money::make('item_product_quantity')
                                        ->label('Quantidade')
                                        ->prefix(null)
                                ])
                        ]),
                ])->submitAction(
                    new HtmlString(
                        Blade::render(<<<BLADE
                                            <x-filament::button
                                                type="submit"
                                                size="sm">
                                                Gravar
                                            </x-filament::button>
                                        BLADE)
                    )
                )


                    
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('product_image')
                    ->label('')
                    ->circular(),
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_code')
                    ->label('Codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product_price')
                    ->label('Preco')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->label('Excluir')
                    ->modalHeading('Atencao')
                    ->modalDescription('Voce realmente deseja excluir essa categoria?'),
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
