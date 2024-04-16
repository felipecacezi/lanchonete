<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cadastros';

    protected static ?string $label = 'Item';

    protected static ?string $pluralLabel = 'Itens';

    protected static ?string $navigationLabel = 'Itens';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('supplier_id')
                    ->label('Fornecedor')
                    ->options(Supplier::all()->pluck('supplier_name', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('item_name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('item_code')
                    ->required()
                    ->label('Codigo')
                    ->maxLength(4),
                Forms\Components\FileUpload::make('item_image')
                    ->image()
                    ->label('Imagem'),
                RichEditor::make('item_obs')->disableToolbarButtons([
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
                Toggle::make('item_active')
                    ->label('Ativo')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true)
                    ->required(),                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier_id')
                    ->label('Fornecedor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item_name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('item_code')
                    ->label('Codigo')
                    ->searchable(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
