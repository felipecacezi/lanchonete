<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Wizard::make([
                    Wizard\Step::make('Cardápio')
                        ->schema([
                            Forms\Components\TextInput::make('virtual_menu_title')
                                ->label('Titulo')
                                ->required()
                                ->maxLength(100),
                            Toggle::make('virtual_menu_active')
                                ->label('Ativo')
                                ->onColor('success')
                                ->offColor('danger')
                                ->default(true)
                                ->required(),    
                        ]),
                    Wizard\Step::make('Produtos')
                        ->schema([


                            Repeater::make('productsMenus')
                                ->relationship()
                                ->schema([

                                    Select::make('product_id')
                                        ->options(Product::all()->pluck('product_name', 'id'))

                                ]),

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
                Tables\Columns\TextColumn::make('virtual_menu_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('virtual_menu_active')
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
