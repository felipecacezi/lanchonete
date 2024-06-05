<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;
use Illuminate\Support\Js;
use Illuminate\Contracts\Support\Htmlable;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            ...(static::canCreateAnother() ? [$this->getCreateAnotherFormAction()] : []),
            $this->getCancelFormAction(),
        ];
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
        return __('Novo Pedido');
    }

    public function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? __('Novo Pedido');
    }

    public function calculateProductValue($productId, $productQuantity)
    {
        echo $productId;
    }
}
