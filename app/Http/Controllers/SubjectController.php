<?php

namespace App\Http\Controllers;
use App\Models\subjects;
use App\Traits\HttpResponses;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    use HttpResponses;
   
    /**
     * List all subjects
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */     
    public function index() {
        try{
            $subjects = subjects::with('course')->get();
            return $this->success(
                $subjects,
                'successful',
            200 );
        }catch(Exception $e){
                return $this->error(
                    [],
                    $e->getMessage(),
                500
                );
        }
    }

    /**
     * Save a subject
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */     
    
    public function saveSubject(SubjectRequest $request) {
        try{
            subjects::create($request->validated());
            return $this->success(
                [],
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
