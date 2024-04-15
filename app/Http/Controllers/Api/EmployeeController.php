<?php

namespace App\Http\Controllers\Api;


use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employees::all();
        if ($employees->count() > 0) {
            return response()->json([
                'status' => 200,
                'message'=> $employees
            ], 200);
    }else{
        
            return response()->json([
                'status' => 404,
                'message'=> 'No records Found'
            ], 404);
    }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string|max:191',
            'age'=> 'required|string|max:191',
            'address'=> 'required|string|max:191',
            'position'=> 'required|string|max:191'
        ]) ;

        if ($validator->fails()) {

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()
            ], 422) ;
        }else{

            $employees = Employees::create([

                'name' => $request-> name,
                'age' => $request-> age,
                'address' => $request-> address,
                'position' => $request-> position
            ]);

        }
        if ($employees) {

            return response()->json([
                'status'=> 200,
                'message'=> 'Employee Added Successfully'
            ], 200);
        }else{

            return response()->json([
                'status'=> 500,
                'message'=> 'Something Went Wrong!'
            ], 500);
        }
    }
    public function show($id)
    {
        $employee = Employees::find($id);
        if ($employee) {
            return response()->json([
                'status'=> 200,
                'employee'=> $employee
            ], 200);

        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Employee Found'
            ], 404);
        }
    }

    public function edit($id)
    {
        $employee = Employees::find($id);
        if ($employee) {
            return response()->json([
                'status'=> 200,
                'employee'=> $employee
            ], 200);

        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Employee Found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string|max:191',
            'age'=> 'required|string|max:191',
            'address'=> 'required|string|max:191',
            'position'=> 'required|string|max:191'
        ]) ;

        if ($validator->fails()) {

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()
            ], 422) ;
        }else{

            $employees = Employees::find($id);
            

        }
        if ($employees) {

            $employees->update([

                'name' => $request-> name,
                'age' => $request-> age,
                'address' => $request-> address,
                'position' => $request-> position
            ]);

            return response()->json([
                'status'=> 200,
                'message'=> 'Employee Updated Successfully'
            ], 200);
        }else{

            return response()->json([
                'status'=> 404,
                'message'=> 'Not Found'
            ], 404);
        }
    }

    public function destroy(int $id)
    {
        $employees = Employees::find($id);

        if ($employees) {

            $employees->delete();
            return response()->json([
                'status'=> 200,
                'message'=> 'Deleted successfully'
            ], 200);

        } else {

            return response()->json([
                'status'=> 404,
                'message'=> 'Not Found'
            ], 404);
        }
    }
}
