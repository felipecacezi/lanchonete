<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Throwable;
use Filament\Actions;
use Illuminate\Support\Js;
use Filament\Actions\Action;
use Filament\Support\Exceptions\Halt;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\CategoryResource;
use function Filament\Support\is_app_url;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label('Gravar')
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return Action::make('createAnother')
            ->label('Criar e criar novo')
            ->action('createAnother')
            ->keyBindings(['mod+shift+s'])
            ->color('gray');
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label('Cancelar')
            ->alpineClickHandler('document.referrer ? window.history.back() : (window.location.href = ' . Js::from($this->previousUrl ?? static::getResource()::getUrl()) . ')')
            ->color('gray');
    }

    public function getTitle(): string | Htmlable
    {
        return __('Novo Produto');
    }

    public function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? __('Novo Produto');
    }

}
