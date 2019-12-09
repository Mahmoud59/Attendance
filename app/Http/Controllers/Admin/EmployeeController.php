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
use App\Http\Requests\Admin\EmployeeRequest;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
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

    public function store(EmployeeRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails())
        {
            return view('employee.create');
        }

        $request['user_id'] = session('id');
        $newEmployee = Employee::create($request->all());

        return redirect('admin/employees');
    }

    public function show($id)   // show employee and him attendance in months
    {
        $employee = Employee::find($id);
        $employeeAttendanceMonth = AttendanceMonth::where('employee_id', $id)->get(); 
        return view('employee.show', compact('employee', 'employeeAttendanceMonth'));
    }

    public function emplpoyeeDetails($employeeId, $month, $year)
    {
        //  Get all attendance in special month for employee
        $attendanceMonthDetails = Attendance::where('employee_id', $employeeId)->whereMonth('created_at', $month)->whereYear('created_at', $year)->get();

        return view('employee.attendance-detail', compact('attendanceMonthDetails'));
    }
}
