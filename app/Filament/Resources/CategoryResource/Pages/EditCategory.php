<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Illuminate\Support\Js;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->label('Excluir'),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label('Gravar')
            ->submit('save')
            ->keyBindings(['mod+s']);
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label('Cancelar')
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')')
            ->color('gray');
    }
}
