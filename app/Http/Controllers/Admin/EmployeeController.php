<?php

namespace App\Http\Controllers\Admin;

use App\Model\Employee;
use App\Model\User;
use App\Model\AttendanceMonth;
use App\Model\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('pin_code',function($data){
                    return $data->pin_code;
                })
                ->addColumn('created_at',function($data){
                    return $data->created_at;
                })
                ->addColumn('action', function($data){

                    $btn = '<a href="employees/'.$data->id.'" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee.index');
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
//        $request['user_id'] = Auth::user()->id;
        $newEmployee = Employee::create($request->all());

        return redirect('admin/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        $employeeAttendanceMonth = AttendanceMonth::where('employee_id', $id)->get(); 
        return view('employee.show', compact('employee', 'employeeAttendanceMonth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function emplpoyeeDetails($employeeId, $month, $year)
    {
        $attendanceMonthDetails = Attendance::where('employee_id', $employeeId)->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();

        return view('employee.attendance-detail', compact('attendanceMonthDetails'));
    }
}
