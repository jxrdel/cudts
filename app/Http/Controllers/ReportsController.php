<?php

namespace App\Http\Controllers;

use App\Models\DailyRegister;
use App\Models\Patient;
use App\Models\PatientVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function viewDailyUsage($date)
    {

        $userRecords = PatientVisit::select('ModifiedBy', DB::raw('count(*) as usercount'))
            ->whereDate('DateModified', $date)
            ->groupBy('ModifiedBy')
            ->get();

        if ($userRecords) {
            foreach ($userRecords as $user) {
                $caseCardCount = Patient::select('ModifiedBy', DB::raw('count(*) as casecardcount'))
                    ->whereDate('DateModified', $date)
                    ->where('ModifiedBy', $user->ModifiedBy)
                    ->groupBy('ModifiedBy')
                    ->get();

                foreach ($caseCardCount as $count) {
                    $user->caseCardCount = $count->casecardcount;
                }

                $dailyRegisterCount = DailyRegister::select('ModifiedBy', DB::raw('count(*) as dailyregistercount'))
                    ->whereDate('DateModified', $date)
                    ->where('ModifiedBy', $user->ModifiedBy)
                    ->groupBy('ModifiedBy')
                    ->get();

                foreach ($dailyRegisterCount as $count) {
                    $user->dailyRegisterCount = $count->dailyregistercount;
                }
            }
        }


        return view('viewdailyusage', compact('userRecords', 'date'));
    }

    public function viewRangeUsage($startdate, $enddate)
    {
        $userRecords = PatientVisit::select('ModifiedBy', DB::raw('count(*) as usercount'))
            ->whereBetween('DateCreated', [$startdate, $enddate])
            ->groupBy('ModifiedBy')
            ->get();

        if ($userRecords) {
            foreach ($userRecords as $user) {
                $caseCardCount = Patient::select('ModifiedBy', DB::raw('count(*) as casecardcount'))
                    ->whereBetween('DateCreated', [$startdate, $enddate])
                    ->where('ModifiedBy', $user->ModifiedBy)
                    ->groupBy('ModifiedBy')
                    ->get();

                foreach ($caseCardCount as $count) {
                    $user->caseCardCount = $count->casecardcount;
                }

                $dailyRegisterCount = DailyRegister::select('ModifiedBy', DB::raw('count(*) as dailyregistercount'))
                    ->whereBetween('DateCreated', [$startdate, $enddate])
                    ->where('ModifiedBy', $user->ModifiedBy)
                    ->groupBy('ModifiedBy')
                    ->get();

                foreach ($dailyRegisterCount as $count) {
                    $user->dailyRegisterCount = $count->dailyregistercount;
                }
            }
        }


        return view('rangeusage', compact('userRecords', 'startdate', 'enddate'));
    }

    // public function getDailyUsage(Request $request)
    // {
    //     $date = $request->input('date');

    //     $userRecords = PatientVisit::whereDate('DateCreated', $date)
    //         ->get();
    // }
}
