<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Traits\HttpResponses;
use App\Http\Requests\CourseRequest;
use Exception;

class CourceController extends Controller
{
    use HttpResponses;

    /**
     * List all cources
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function index() {
        try{
            $courses = Course::all();
            return $this->success(
                [
                    $courses
                ],
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
     * Create a cource
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    
     public function saveCources(CourseRequest $request) {
        try{
            $course = Course::create($request->validated());
            return $this->success(
                [],
                'successful created',
                200
            );
        }catch(Exception $e){
                return $this->error(
                    [],
                    $e->getMessage(),
                
                );
        }
    }

    /**
     * Entrol students to cource
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function enrollStudents(Request $request, $courseId)
    { 
        try{
            $course = Course::findOrFail($courseId);

            $studentIds = $request->input('student_ids', []);
            // Attach students to the course using the pivot table
            $course->students()->syncWithoutDetaching($studentIds);
            return $this->success(
                [],
                'Successfully enrolled',
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
}
