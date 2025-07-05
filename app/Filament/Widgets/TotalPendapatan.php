<?php

namespace App\Filament\Widgets;

use App\Models\Pesanan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;

class TotalPendapatan extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPendapatan = Pesanan::where('status', 'selesai')
            ->where('status_pembayaran', 'dibayar')
            ->sum('total_harga');

        return [
            Card::make('Total Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.')),
        ];
    }
}
