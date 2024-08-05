<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use App\Services\Interfaces\DashboardServiceInterface;
use Carbon\Carbon;

/**
 * Class DashboardService
 * @package App\Services
 */
class DashboardService implements DashboardServiceInterface
{
    public function getDashboardData()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalReviews = Review::count();
        $monthlySalesData = $this->getMonthlySalesData();
        $topUsers = $this->getTopUsers();
        $topProducts = $this->getTopProducts();

        return [
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'totalReviews' => $totalReviews,
            'monthlySalesData' => $monthlySalesData,
            'topUsers' => $topUsers,
            'topProducts' => $topProducts,
        ];
    }

    public function getMonthlySalesData()
    {
        $salesData = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as sales')
            ->where('status', 'delivered')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->month => $item->sales];
            })
            ->toArray();


        $months = range(1, 12);
        $monthlySales = array_map(function ($month) use ($salesData) {
            return $salesData[$month] ?? 0;
        }, $months);

        return $monthlySales;
    }

    public function getTopUsers()
    {
        $topUsers = Order::with('user')
            ->selectRaw('user_id, SUM(total_price) as total_spent')
            ->where('status', 'delivered')
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'user_name' => $order->user->name,
                    'total_spent' => $order->total_spent,
                    'avatar' => $order->user->avatar,
                ];
            });

        return $topUsers;
    }

    public function getTopProducts()
    {
        $topProducts = Product::with('main_image')
            ->select('id', 'name', 'quantity_sold')
            ->orderByDesc('quantity_sold')
            ->take(5)
            ->get()
            ->map(function ($product) {
                return [
                    'name' => $product->name,
                    'quantity_sold' => $product->quantity_sold,
                    'main_image' => $product->main_image,
                ];
            });

        return $topProducts;
    }
}
