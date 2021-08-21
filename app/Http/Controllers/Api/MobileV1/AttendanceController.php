<?php

namespace App\Http\Controllers\Api\MobileV1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use DB;

class AttendanceController extends Controller
{
    public function attendance(Request $request, $key_token){
        
        $response = [
            'success' => false,
            'message' => '',
        ];

        if($request->has('photo')){

            DB::beginTransaction();

            try{
                
                $file     = $request->file('photo');
                $exte     = $file->extension();
                $filename = $request->attendanceValue.'_'.date('Ymdhis').$exte;
                $path     = $file->storeAs('public/employees/'.$request->employeeNo.'', $filename);

                $employee = Employee::where('key_token', $key_token)->first();

                $attendance              = new Attendance();
                $attendance->employee_id = $employee->id;
                $attendance->photo       = $filename;
                $attendance->type        = $request->attendanceValue;
                if($attendance->save()){
                    $response['success'] = true;
                    $response['message'] = 'Successful '.$request->attendanceLabel.' '.date('h:i:s a').' ';
                    DB::commit();
                }

            }catch(\Exception $e){
                DB::rollback();
            }

        }

        return response()->json($response, 200);
    }
}
