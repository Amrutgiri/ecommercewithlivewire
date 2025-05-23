<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Forms\Components\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan='full';
    protected static ?int $sort =2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at','desc')
            ->columns([
                TextColumn::make('id')->searchable()->label('OrderID'),
                TextColumn::make('user.name')->searchable()->label('Customer'),
                TextColumn::make('grand_total')->money('INR')->searchable()->label('Grand Total'),
                TextColumn::make('status')->badge()->color(fn(string $state):string=>match($state){
                    'new'=>'info',
                    'processing'=>'warning',
                    'shipped'=>'success',
                    'delivered'=>'success',
                    'cancelled'=>'danger',
                })->icon(fn(string $state):string=>match($state){
                    'new' => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'shipped' => 'heroicon-m-truck',
                    'delivered' => 'heroicon-m-check-badge',
                    'cancelled' => 'heroicon-m-x-circle',
                })->sortable(),

                TextColumn::make('payment_method')->searchable()->label('Payment Method'),
                TextColumn::make('payment_status')->searchable()->label('Payment Status')->badge(),
                TextColumn::make('created_at')->label('Order Date')->dateTime(),
            ])
            ->actions([
                Tables\Actions\Action::make('View Order')
                    ->url(fn(Order $record): string =>OrderResource::getUrl('view',['record'=>$record]))
                    ->icon('heroicon-m-eye')
            ]);
    }
}
