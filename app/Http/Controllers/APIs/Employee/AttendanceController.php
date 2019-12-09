<?php

namespace App\Http\Controllers\APIs\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Attendance;
use App\Model\AttendanceMonth;
use APP\Model\Employee;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function check()
    {
        $employeeId = Auth::guard('employee-api')->user()->id;
    	$employee = Employee::find($employeeId);
    	$attendance = Attendance::where('employee_id', $employee->id)->latest('created_at')->first();

        // if employee check-in first time
        if($attendance === null)
        {
            $newAttendance = Attendance::create([
                    'check_in' => date("h:i:s", time()),
                    'day'  => date("d", time()),
                    'employee_id' => $employeeId,
                ]);

            return response()->json([
                'status_code' => 201,
                'success' => true,
                'message' => 'Check in Successfully',
                'data'  => $newAttendance
            ]);
        }

        // if employee checked out in last time
    	if($attendance->check_out)
    	{
    		$newAttendance = Attendance::create([
    				'check_in' => date("h:i:s", time()),
    				'day'  => date("d", time()),
    				'employee_id' => $employeeId,
    			]);

    		return response()->json([
                'status_code' => 201,
                'success' => true,
                'message' => 'Check in Successfully',
                'data'  => $newAttendance
            ]);

    	}

        // if employee still login and will check-out
    	else
    	{
    		$attendance->check_out = date("h:i:s", time());
    		$attendance->save();

            // check if employee will check-out in same month
            $attenanceMonth = AttendanceMonth::where('employee_id', $employeeId)->where('month', date("m", time()))->where('year', date("Y", time()))->first();
            if($attenanceMonth)
            {
                $hours =  date("H:i:s", (new Carbon($attendance->check_out))->diffInSeconds(new Carbon($attendance->check_in)));

                $attenanceMonth->hours = Carbon::createFromFormat('H:i:s',$attenanceMonth->hours)->addHours(intval($hours));

                $attenanceMonth->save();
            }

            // check if employee will check-out in new month
            else
            {
                $hours =  date("H:i:s", (new Carbon($attendance->check_out))->diffInSeconds(new Carbon($attendance->check_in)));
                AttendanceMonth::create([
                        'hours' => $hours,
                        'month' => date("m", time()),
                        'year' => date("Y", time()),
                        'employee_id' => $employeeId
                    ]);
            }

    		return response()->json([
                'status_code' => 201,
                'success' => true,
                'message' => 'Check out Successfully',
                'data'  => $attendance
            ]);
    	}
    }
}
