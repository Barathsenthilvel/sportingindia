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

        $summary['pending_count']  =  count($summaryArr['0']);
        $summary['approval_count'] =  count($summaryArr['1']);
        $summary['rejected_count'] =  count($summaryArr['2']);

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
            $users = User::where('role_id',2)->select(['id', 'name', 'email', 'created_at']);
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<a href="/users/' . $user->id . '/approve" class="btn btn-sm btn-success">Approve</a> <a href="/users/' . $user->id . '/reject" class="btn btn-sm btn-danger">Reject</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        else{
            return view('user.pendingapplications');
        }



    }

    public function getApprovedApplications()
    {
        return view('user.approvalapplications');
    }

    public function getRejectedApplications()
    {
        return view('user.rejectapplications');
    }


}
