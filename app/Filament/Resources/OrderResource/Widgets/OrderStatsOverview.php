<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Produk', Product::count())
                ->icon('heroicon-o-rectangle-stack'),
            Stat::make('Jumlah Seluruh Pesanan', Order::count())
                ->icon('heroicon-o-inbox-arrow-down'),
            Stat::make('Jumlah Pelanggan', Customer::count())
                ->icon('heroicon-o-user-group'),
        ];
    }
}
