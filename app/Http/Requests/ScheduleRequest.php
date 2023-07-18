<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\schedules;
use App\Models\Course;
use Illuminate\Http\Response;

use App\Traits\HttpResponses;

class ScheduleRequest extends FormRequest
{
    
    use HttpResponses;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'batch_id' => [
                'required',
                Rule::unique('schedules', 'batch_id'),
            ],
            'url' => 'required|url',
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date',
            'status' => 'nullable',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

     protected function failedValidation(Validator $validator)
     {
         throw new HttpResponseException(
             $this->error(
                 $validator->errors(),
                 'Validation failed',
                 Response::HTTP_UNPROCESSABLE_ENTITY
                 )
             );
     }
}

