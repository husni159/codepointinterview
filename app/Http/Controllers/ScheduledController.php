<?php

namespace App\Http\Controllers;
use App\Models\schedules;
use App\Traits\HttpResponses;
use App\Http\Requests\ScheduleRequest;

use Illuminate\Http\Request;

class ScheduledController extends Controller
{
    use HttpResponses;
    
    /**
     * List all scheduled batch
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

     public function index() {
        try{
            $schedules = schedules::with('course')->get();
            return $this->success(
                $schedules,
                'successful',
                200
            );
        }catch(Exception $e){
                return $this->error(
                    [],
                    $e->getMessage(),
                500
                );
        }
    }

    /**
     * Schedule a batch
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */    
    
    public function createSchedule(ScheduleRequest $request) {
        try{
            $batchDetails = schedules::create($request->validated());
            return $this->success(
                [$batchDetails],
                'successfullycreated',
                200
            );
        }catch(Exception $e){
                return $this->error(
                    [],
                    $e->getMessage(),
                
                );
        }
   
    }
}