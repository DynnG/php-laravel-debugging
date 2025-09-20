<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentService {

    public function getAllStudents( ) {
        try {
            $students = Students::all();
            Log::info("Successfully fetched all students.", ['count' => $students->count()]);
            return $students;
        } catch (Exception $e) {
            Log::error("Error fetching all students: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            throw new Exception("Unable to fetch students. Check Laravel logs for more info.", 500);
        }
    }

    public function getStudentById($id) {
        try {
            $student = Student::find($id);

            if (!$student) {
                Log::warning("Student not found.", ['id' => $id]);
                return null;
            }

            Log::info("Student fetched successfully.", ['id' => $id]);
            return $student;
        } catch (Exception $e) {
            Log::error("Error fetching student by ID: " . $e->getMessage(), ['id' => $id]);
            throw new Exception("Unable to fetch student. Check Laravel logs for more info.", 500);
        }
    }

    public function addStudent($data) {
        try {
            $student = Student::create($data);
            Log::info("Student created successfully.", ['id' => $student->id]);
            return $student;
        } catch (Exception $e) {
            Log::error("Error adding student: " . $e->getMessage(), ['data' => $data]);
            throw new Exception("Unable to add student. Check Laravel logs for more info.", 500);
        }
    }

    public function updateStudent($id, $data) {
        try {
            $student = Student::find($id);

            if (!$student) {
                Log::warning("Student not found for update.", ['id' => $id]);
                return null;
            }

            $student->update($data);
            Log::info("Student updated successfully.", ['id' => $id]);
            return $student;
        } catch (Exception $e) {
            Log::error("Error updating student: " . $e->getMessage(), ['id' => $id, 'data' => $data]);
            throw new Exception("Unable to update student. Check Laravel logs for more info.", 500);
        }
    }

    public function deleteStudent($id) {
        try {
            $student = Student::find($id);

            if (!$student) {
                Log::warning("Student not found for deletion.", ['id' => $id]);
                return false;
            }

            $student->delete();
            Log::info("Student deleted successfully.", ['id' => $id]);
            return true;
        } catch (Exception $e) {
            Log::error("Error deleting student: " . $e->getMessage(), ['id' => $id]);
            throw new Exception("Unable to delete student. Check Laravel logs for more info.", 500);
        }
    }
}
