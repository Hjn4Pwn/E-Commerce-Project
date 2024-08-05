<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\DashboardServiceInterface;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $data = $this->dashboardService->getDashboardData();
        // dd($data);
        return view('admin.pages.dashboard', [
            'page' => 'Tổng quan số liệu',
            'data' => $data,
        ]);
    }
}
