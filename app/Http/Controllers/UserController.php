<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $summaryArr = User::where('role_id',2)->get()->groupBy('is_approved')->toArray();

        $summary['pending_count']  =  isset($summaryArr['0']) ? count($summaryArr['0']) : 0;
        $summary['approval_count'] =  isset($summaryArr['1']) ? count($summaryArr['1']) : 0;
        $summary['rejected_count'] =  isset($summaryArr['2']) ? count($summaryArr['2']) : 0;

        return view('user.dashboard')->with('summary',$summary);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPendingApplications(Request $request)
    {
        if($request->ajax())
        {
            $users = User::where('role_id',2)->where('is_approved',0)->select(['id', 'name', 'email', 'created_at']);
            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '<a href="#" class="btn btn-sm btn-success" onclick="approveUser('.$user->id.')" >Approve</a> <a href="#" class="btn btn-sm btn-danger" onclick="rejectUser('.$user->id.')">Reject</a>';
            })
            ->rawColumns(['action'])
                ->make(true);
        }
        else{
            return view('user.pendingapplications');
        }



    }

    public function getApprovedApplications(Request $request)
    {
        if($request->ajax())
        {
            $users = User::where('role_id',2)->where('is_approved',1)->select(['id', 'name', 'email', 'created_at']);
            return DataTables::of($users)
                 ->addIndexColumn()
                ->make(true);
        }
        else{
            return view('user.approvedapplications');
        }

    }

    public function getRejectedApplications(Request $request)
    {
        if($request->ajax())
        {
            $users = User::where('role_id',2)->where('is_approved',2)->select(['id', 'name', 'email', 'created_at']);
            // dd($users);
            return DataTables::of($users)
                ->addIndexColumn()
                ->make(true);
        }
        else{
            return view('user.rejectapplications');
        }
    }

    public function rejectApplication(Request $request)
    {
        $userId  = $request->userid;

        $is_updated = User::where('id',$userId)->update(['is_approved' => 2]);

        if($is_updated)
        {
            $response = [
                'status' => 'success',
                'message' => 'Application Rejected Successfully',
            ];

            return $response;
        }
        else{
            $response = [
                'status' => 'failed',
                'message' => 'Something went wrong!!',
            ];

            return $response;
        }
    }


    public function approveApplication(Request $request)
    {
        $userId  = $request->userid;

        $is_updated = User::where('id',$userId)->update(['is_approved' => 1,'approved_at' => now()]);

        if($is_updated)
        {
            $response = [
                'status' => 'success',
                'message' => 'Application Approved Successfully',
            ];

            return $response;
        }
        else{
            $response = [
                'status' => 'failed',
                'message' => 'Something went wrong!!',
            ];

            return $response;
        }
    }



    public function profilepage()
    {
        return view('user.profile');
    }


}
