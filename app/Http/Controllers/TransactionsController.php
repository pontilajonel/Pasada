<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */



        public function getBooking($userID)
    {
            $status = 'waiting';

        $tableData = Transactions::join('users as s', 'transactions.student_userid', '=', 's.id')
            ->join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('transactions.id','d.name as driver','d.id as driverid','l.destinations as destination','transactions.pickup','transactions.passengernumber','transactions.payment','d.phonenumber')
                        ->where('transactions.student_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }


    }
    public function getcanceledBooking($userID)
    {
            $status = 'canceled';

        $tableData = Transactions::join('users as s', 'transactions.student_userid', '=', 's.id')
            ->join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('transactions.id','d.name as driver','l.destinations as destination','transactions.pickup','transactions.passengernumber','transactions.payment','d.phonenumber')
                        ->where('transactions.student_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }


    }

    public function getapprovedBooking($userID)
    {
            $status = 'approved';

        $tableData = Transactions::join('users as s', 'transactions.student_userid', '=', 's.id')
            ->join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('d.name as driver','l.destinations as destination','transactions.pickup','transactions.passengernumber','transactions.payment','d.phonenumber')
                        ->where('transactions.student_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }


    }
    public function getdoneBooking($userID)
    {
            $status = 'done';

        $tableData = Transactions::join('users as s', 'transactions.student_userid', '=', 's.id')
            ->join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('d.name as driver','l.destinations as destination','transactions.pickup','transactions.passengernumber','transactions.payment','d.phonenumber')
                        ->where('transactions.student_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }


    }



    public function addTransaction(Request $request)
{
    $solo = 30;
    $duo = 50;
    $trio = 60;
    $uppat = 80;
    $lima = 100;

    $attrs = $request->validate([
        'student_userid' => 'required',
        'driver_userid' => 'required',
        'loc_id' => 'required',
        'pickup' => 'required|max:20',
        'passengernumber' => 'required|max:10'
    ]);

    $payment = null; // Initialize payment variable

    // Determine payment amount based on passengernumber
    switch ($attrs['passengernumber']) {
        case 1:
            $payment = $solo;
            break;
        case 2:
            $payment = $duo;
            break;
        case 3:
            $payment = $trio;
            break;
        case 4:
            $payment = $uppat;
            break;
        case 5:
            $payment = $lima;
            break;
        default:
            // Handle default case if needed
            break;
    }

    // Create transaction with calculated payment
    Transactions::create([
        'student_userid' => $attrs['student_userid'],
        'driver_userid' => $attrs['driver_userid'],
        'loc_id' => $attrs['loc_id'],
        'pickup' => $attrs['pickup'],
        'passengernumber' => $attrs['passengernumber'],
        'payment' => $payment,
    ]);

    return response([
        'response' => 'Transaction added!'
    ], 200);
}

function editTransaction(Request $req, string $id){
    $solo = 30;
    $duo = 50;
    $trio = 60;
    $uppat = 80;
    $lima = 100;

    $validator = Validator::make($req->all(), [
        'pickup' => 'required|max:20',
        'loc_id' => 'required',
        'passengernumber' => 'required|max:10',
        'status' => 'required'
    ]);

    if ($validator->fails()) {
        return response([
            'response' => 'error'
        ], 403);
    } else {
        $bayad = null; // Initialize bayad variable

        // Determine bayad amount based on passengernumber
        switch ($req->passengernumber) {
            case 1:
                $bayad = $solo;
                break;
            case 2:
                $bayad = $duo;
                break;
            case 3:
                $bayad = $trio;
                break;
            case 4:
                $bayad = $uppat;
                break;
            case 5:
                $bayad = $lima;
                break;
            default:
                // Handle default case if needed
                break;
        }

        $transactions = Transactions::find($id);
        $transactions->pickup = $req->pickup;
        $transactions->loc_id = $req->loc_id;
        $transactions->status = $req->status;
        $transactions->passengernumber = $req->passengernumber;
        $transactions->payment = $bayad; // Assign the calculated payment amount

        $transactions->save();

        return response([
            'response' => 'success'
        ], 200);
    }
}
    function deleteTransaction(Request $req,string $id){
        $validator = Validator::make($req -> all(),[
            'status'



        ]);

        if($validator -> fails()){
            return response ([
                'response'=>'error'
            ],403);
        }else{

            $transactions = Transactions::find($id);
            $transactions-> status=$req->status;

            $transactions->save();


            return response([
                'reponse' => 'success'
            ],200);
        }
    }

    public function doneTransaction(Request $request, $id)
    {
    $status = 'done';

    $transaction = Transactions::find($id);

    // Use the update method to update the status
    $transaction->update([
        'status' => $status,
    ]);

    return response()->json($transaction, 200);
    }

    public function getdriverBooking($userID)
    {
            $status = 'waiting';

        $tableData = Transactions::join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('users as p', 'transactions.student_userid', '=', 'p.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('transactions.id', 'p.name as passenger','l.destinations as destination','transactions.pickup','transactions.payment','transactions.passengernumber','p.phonenumber')
                        ->where('transactions.driver_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }
    }

    public function getapproveddriverBooking($userID)
    {
            $status = 'approved';

        $tableData = Transactions::join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('users as p', 'transactions.student_userid', '=', 'p.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('transactions.id', 'p.name as passenger','l.destinations as destination','transactions.pickup','transactions.payment','transactions.passengernumber','p.phonenumber')
                        ->where('transactions.driver_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }


    }

    public function getdonedriverBooking($userID)
    {
            $status = 'done';

        $tableData = Transactions::join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('users as p', 'transactions.student_userid', '=', 'p.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('transactions.id', 'p.name as passenger','l.destinations as destination','transactions.pickup','transactions.payment','transactions.passengernumber','p.phonenumber')
                        ->where('transactions.driver_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }


    }

    public function getcanceldriverBooking($userID)
    {
            $status = 'canceled';

        $tableData = Transactions::join('users as d', 'transactions.driver_userid', '=', 'd.id')
            ->join('users as p', 'transactions.student_userid', '=', 'p.id')
            ->join('locations as l', 'transactions.loc_id', '=', 'l.id')
            ->select('transactions.id', 'p.name as passenger','l.destinations as destination','transactions.pickup','transactions.payment','transactions.passengernumber','p.phonenumber')
                        ->where('transactions.driver_userid', '=', $userID)
                        ->where('transactions.status', '=', $status)
            ->get();

            if($tableData==''){
                return response([
                    'response' => 'No Record Found'
                ], 404);
            }else{
                return response([
                    $tableData
                ],200);
            }


    }

    public function confirmTransaction(Request $request, $id)
    {
    $status = 'approved';

    $transaction = Transactions::find($id);

    // Use the update method to update the status
    $transaction->update([
        'status' => $status,
    ]);

    return response()->json($transaction, 200);
    }

    public function cancelTransaction(Request $request, $id)
    {
    $status = 'canceled';

    $transaction = Transactions::find($id);

    // Use the update method to update the status
    $transaction->update([
        'status' => $status,
    ]);

    return response()->json($transaction, 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
