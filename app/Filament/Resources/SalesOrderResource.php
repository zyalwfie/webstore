<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\SalesOrder;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\SalesOrderResource\Pages;
use App\Services\RegionQueryService;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Model;

class SalesOrderResource extends Resource
{
    protected static ?string $model = SalesOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Sales Order General Information')
                    ->description('Meta & Customer Info')
                    ->schema([
                        TextEntry::make('trx_id')
                            ->label('TRX ID')
                            ->inlineLabel(),
                        TextEntry::make('status')
                            ->formatStateUsing(fn($state) => $state->label())
                            ->inlineLabel(),
                        TextEntry::make('customer_full_name')
                            ->label('Customer Name')
                            ->inlineLabel(),
                        TextEntry::make('customer_email')
                            ->label('Customer Email')
                            ->inlineLabel(),
                        TextEntry::make('customer_phone')
                            ->label('Customer Phone')
                            ->inlineLabel(),
                        TextEntry::make('address_line')
                            ->label('Shipping Address')
                            ->formatStateUsing(function ($state, SalesOrder $sales_order) {
                                $region = app(RegionQueryService::class)
                                    ->searchRegionByCode($sales_order->destination_code);

                                return "$state -> {$region->label}";
                            })
                            ->inlineLabel(),
                    ]),
                Section::make('Shipping Details')
                    ->schema([
                        TextEntry::make('shipping_driver')
                            ->label('Vendor')
                            ->inlineLabel(),
                        TextEntry::make('shipping_courier')
                            ->inlineLabel(),
                        TextEntry::make('shipping_service')
                            ->inlineLabel(),
                        TextEntry::make('shipping_estimated_delivery')
                            ->inlineLabel(),
                        TextEntry::make('shipping_weight')
                            ->suffix(' gram')
                            ->inlineLabel(),
                        TextEntry::make('shipping_receipt_number')
                            ->inlineLabel(),
                    ])
                    ->collapsed(),
                RepeatableEntry::make('items')
                    ->schema([
                        TextEntry::make('name')
                            ->formatStateUsing(fn($state, Model $record) => "({$record->sku}) $state"),
                        TextEntry::make('quantity'),
                        TextEntry::make('price')
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                        TextEntry::make('total')
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                    ])
                    ->hiddenLabel()
                    ->columnSpanFull()
                    ->columns(4),
                Section::make('Summaries')
                    ->schema([
                        TextEntry::make('payment_label')
                            ->inlineLabel(),
                        TextEntry::make('payment_paid_at')
                            ->label('Paid at')
                            ->inlineLabel(),
                        TextEntry::make('sub_total')
                            ->formatStateUsing(fn($state) => Number::currency($state))
                            ->inlineLabel(),
                        TextEntry::make('shipping_total')
                            ->formatStateUsing(fn($state) => Number::currency($state))
                            ->inlineLabel(),
                        TextEntry::make('total')
                            ->formatStateUsing(fn($state) => Number::currency($state))
                            ->inlineLabel(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('trx_id'),
                TextColumn::make('customer_full_name'),
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => $state->label()),
                TextColumn::make('total')
                    ->formatStateUsing(fn($state) => Number::currency($state))
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
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
            'index' => Pages\ListSalesOrders::route('/'),
            'view' => Pages\ViewSalesOrder::route('/{record}'),
        ];
    }
}
