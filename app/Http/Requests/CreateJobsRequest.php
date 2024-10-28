<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'job_name'=>'required',
            'job_active'=>'required',
            'photo'=>'required|max:1000|mimes:png,jpg'
        ];
    }


    public function messages()
    {
        return [
           'job_name.required'=> 'The job name is required' ,
           'job_name.required'=> 'The Active Status  is required' 
        ];
        
    }
   

}
