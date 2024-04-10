<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;

use Filament\Forms\Components\Toggle;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Configuracoes';

    protected static ?string $label = 'Categoria';

    protected static ?string $pluralLabel = 'Categorias';

    protected static ?string $navigationLabel = 'Categorias';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cat_name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('cat_code')
                    ->label('Codigo')
                    ->required()
                    ->maxLength(4),
                Forms\Components\Textarea::make('cat_obs')
                    ->label('Observacao')
                    ->columnSpanFull(),
                Toggle::make('cat_active')
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
                Tables\Columns\TextColumn::make('cat_name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cat_code')
                    ->label('Codigo')
                    ->searchable()
            ])
            ->filters([])
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
