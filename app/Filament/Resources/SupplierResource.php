<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;


class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Cadastros';

    protected static ?string $label = 'Fornecedor';

    protected static ?string $pluralLabel = 'Fornecedores';

    protected static ?string $navigationLabel = 'Fornecedores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('supplier_name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(50),
                RichEditor::make('supplier_description')->disableToolbarButtons([
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
                Forms\Components\TextInput::make('supplier_email')
                    ->label('Email')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('supplier_phone')
                    ->label('Telefone')
                    ->required()
                    ->maxLength(12),
                Forms\Components\TextInput::make('supplier_address')
                    ->label('Endereco')
                    ->required()
                    ->maxLength(12),
                Toggle::make('supplier_active')
                    ->label('Ativo')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true)
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier_name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier_email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier_phone')
                    ->label('Telefone')
                    ->searchable(),
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
