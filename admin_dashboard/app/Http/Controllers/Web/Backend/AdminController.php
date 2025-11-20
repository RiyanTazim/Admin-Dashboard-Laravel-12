<?php
namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // // $total_users = User::count();
        $total_users = User::where('email', '!=', 'iqu@iqu.com')->count();
        // $total_orders = Order::where('payment_status', '!=', 'pending')->count();
        // $total_products = Product::count();
        $premium_users = User::where('is_premium', 1)->count();
        // $total_care_plan = CarePlan::count();
        // $total_payments = Order::where('payment_status', 'paid')->sum('total_amount');

        // /* --- User chart data  start --- */
        // $newUsers = User::where('role', 'user')
        //     ->whereYear('created_at', now()->year)
        //     ->get();

        // // Define all months of the year
        // $months = [
        //     'January',
        //     'February',
        //     'March',
        //     'April',
        //     'May',
        //     'June',
        //     'July',
        //     'August',
        //     'September',
        //     'October',
        //     'November',
        //     'December'
        // ];

        // // Initialize all months with 0
        // $userCountsByMonth = array_fill_keys($months, 0);

        // // Group the users by the month they were created
        // $usersGroupedByMonth = $newUsers->groupBy(function ($user) {
        //     return $user->created_at->format('F'); // Group by month name
        // });

        // // Populate the count of users in the correct month
        // foreach ($usersGroupedByMonth as $month => $users) {
        //     $userCountsByMonth[$month] = count($users);
        // }

        // // Prepare chart data
        // $chartData = [
        //     'labels' => $months,
        //     'data' => array_values($userCountsByMonth), // 12 values, all integers
        // ];
        // // dd($chartData);
        // /* --- User chart data  end--- */

        // /*Total Order chart data start */

        // $totalOrders = Order::where('payment_status', 'paid')->whereYear('created_at', now()->year)->get();

        // // Initialize all months with 0
        // $orderCountsByMonth = array_fill_keys($months, 0);

        // // Group the orders by the month they were created
        // $ordersGroupedByMonth = $totalOrders->groupBy(function ($order) {
        //     return $order->created_at->format('F'); // Group by month name
        // });

        // // Populate the count of orders in the correct month
        // foreach ($ordersGroupedByMonth as $month => $orders) {
        //     $orderCountsByMonth[$month] = count($orders);
        // }

        // // Prepare chart data
        // $orderChartData = [
        //     'labels' => $months,
        //     'data' => array_values($orderCountsByMonth), // 12 values, all integers
        // ];
        // /*Total Order chart data end */

        // /* Total payment chart data start */
        // // Initialize months
        // $months = [
        //     'January',
        //     'February',
        //     'March',
        //     'April',
        //     'May',
        //     'June',
        //     'July',
        //     'August',
        //     'September',
        //     'October',
        //     'November',
        //     'December'
        // ];

        // // Initialize array to hold sums for each month
        // $paymentSumByMonth = array_fill_keys($months, 0);

        // // Get all paid orders for the current year
        // $totalPaymentsByMonth = Order::where('payment_status', 'paid')
        //     ->whereYear('created_at', now()->year)
        //     ->get()
        //     ->groupBy(function ($order) {
        //         return $order->created_at->format('F'); // Group by month name
        //     })
        //     ->map(function ($orders) {
        //         return $orders->sum('total_amount'); // Sum the total_amount for each month
        //     });

        // // Fill the array with payment sums for each month
        // foreach ($paymentSumByMonth as $month => $sum) {
        //     // Check if the month exists in the grouped collection
        //     if ($totalPaymentsByMonth->has($month)) {
        //         $paymentSumByMonth[$month] = $totalPaymentsByMonth[$month];
        //     }
        // }

        // // Prepare chart data
        // $paymentChartData = [
        //     'labels' => $months,
        //     'data' => array_values($paymentSumByMonth), // 12 values, total payments for each month
        // ];

        // /* Total payment chart data end */

        // return view('backend.layouts.dashboard.index', compact('total_users', 'total_orders', 'total_products', 'premium_users', 'total_care_plan', 'total_payments', 'chartData', 'orderChartData', 'paymentChartData'));

        return view('backend.layouts.dashboard.index', compact('total_users', 'premium_users'));
    }
}
