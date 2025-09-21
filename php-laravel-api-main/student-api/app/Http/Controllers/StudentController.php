<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        try {
            $students = $this->studentService->getAllStudents();
            return response()->json($students, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $student = $this->studentService->addStudent($request->all());
            return response()->json($student, 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $student = $this->studentService->getStudentById($id);

            return $student
                ? response()->json($student, 200)
                : response()->json(['message' => 'Student not found'], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $student = $this->studentService->updateStudent($id, $request->all());

            return $student
                ? response()->json($student, 200)
                : response()->json(['message' => 'Student not found'], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $deleted = $this->studentService->deleteStudent($id);

            return $deleted
                ? response()->json(['message'=> 'Student deleted'], 200)
                : response()->json(['message' => 'Student not found'], 404);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Database error',
                'message' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
