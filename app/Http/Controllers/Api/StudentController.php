<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $query = Student::all();
        return $query;
    }

    public function store(Request $request)
    {
        Student::create([
            'firstName' => $request->input('fname'),
            'lastName' => $request->input('lname'),
            'dob' => $request->input('dob'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Student Create Successfully',
        ]);
    }

    public function update(Request $request, $id)
    {

        Student::where('id', $id)
            ->update([
                'firstName' => $request->input('fname'),
                'lastName' => $request->input('lname'),
                'dob' => $request->input('dob'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ]);

        return response()->json([
            'status' => 200,
            'message' => 'Student Updated Successfully',
        ]);
    }

    public function show($id)
    {
        $query = Student::where('id', $id)->get();

        return $query;
    }

    public function delete($id)
    {
        Student::where('id', $id)
            ->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Student Delete Successfully',
        ]);
    }
}
