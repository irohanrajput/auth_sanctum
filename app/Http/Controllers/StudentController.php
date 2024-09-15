<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Student::all()->count() > 0) {
            return response()->json(Student::all());
        } else {
            return response()->json(['message' => 'No student data found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'registration_number' => 'required|unique:students' // Check for uniqueness
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $student = Student::create([
            'name' => $request->name,
            'registration_number' => $request->registration_number,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Student Enrolled Successfully',
            'data' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Student::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'registration_number' => 'sometimes|required|unique:students,registration_number,' . $student->id
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $student->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Student Updated Successfully',
            'data' => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Student Deleted Successfully'
        ]);
    }
}
