<?php

namespace App\Providers;

use App\Models\TonKho;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Schema::defaultStringLength(191);

        $sanPhamHetHang = TonKho::select(DB::raw('SUM(tonkho.soluong) as tongtonkho'))
            ->groupBy('tonkho.sanpham_id')
            ->havingRaw('tongtonkho = 0')
            ->count();


        // biến toàn cục
        view()->share('sanPhamHetHang', $sanPhamHetHang);
    }
}
