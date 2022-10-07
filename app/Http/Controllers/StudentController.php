<?php

namespace App\Http\Controllers;

use App\Packages\Student\Facade\StudentFacade;
use App\Packages\Student\Model\Student;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        protected StudentFacade $studentFacade
    )
    {
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $studentName = $request->get('name');

            $response = $this->studentFacade->enrollStudent($studentName);
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663076218);
        }
    }

    /**
     * @throws Exception
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $students = $this->studentFacade->getStudents();
            $response = $this->getStudentsCollection($students);

            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1665067619);
        }
    }

    private function getStudentsCollection(array $students): \Illuminate\Support\Collection
    {
        $studentsCollections = collect();

        /** @var Student $student */
        foreach ($students as $student) {
            $studentsCollections->add([
                'id' => $student->getId(),
                'name' => $student->getName()
            ]);
        }

        return $studentsCollections;
    }
}