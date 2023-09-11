<?php

namespace App\Http\Controllers\Account;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //count transactions
        $unpaid     = Transaction::where('status', 'UNPAID')->count();
        $paid       = Transaction::where('status', 'PAID')->count();
        $expired    = Transaction::where('status', 'EXPIRED')->count();
        $cancelled  = Transaction::where('status', 'CANCELLED')->count();

        //year
        $year   = date('Y');

        //chart 
        $transactions = DB::table('transactions')
            ->addSelect(DB::raw('SUM(grand_total) as grand_total'))
            ->addSelect(DB::raw('MONTH(created_at) as month'))
            ->addSelect(DB::raw('MONTHNAME(created_at) as month_name'))
            ->addSelect(DB::raw('YEAR(created_at) as year'))
            ->whereYear('created_at', '=', $year)
            ->where('status', 'PAID')
            ->groupBy('month')
            ->orderByRaw('month ASC')
            ->get();

        //define variable array
        $month_name     = [];
        $grand_total    = [];

        if (count($transactions)) {
            foreach ($transactions as $result) {

                //push data to array
                array_push($month_name, $result->month_name);
                array_push($grand_total, (int) $result->grand_total);
            }
        }

        //return view
        return inertia('Account/Dashboard/Index', [
            'count' => [
                'unpaid'    => $unpaid,
                'paid'      => $paid,
                'expired'   => $expired,
                'cancelled' => $cancelled
            ],
            'chart' => [
                'month_name'    => $month_name,
                'grand_total'   => $grand_total
            ]
        ]);
    }
}
