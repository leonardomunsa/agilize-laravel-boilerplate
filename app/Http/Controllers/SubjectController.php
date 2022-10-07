<?php

namespace App\Http\Controllers;

use App\Packages\Exam\Facade\ExamFacade;
use App\Packages\Exam\Model\Subject;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class SubjectController extends Controller
{
    public function __construct(
        protected ExamFacade $examFacade
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

            $response = $this->examFacade->enrollSubject($studentName);
            EntityManager::flush();
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663106115);
        }
    }

    /**
     * @throws Exception
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $subjects = $this->examFacade->getSubjects();
            $response = $this->getSubjectsCollection($subjects);

            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1665067619);
        }
    }

    private function getSubjectsCollection(array $subjects): \Illuminate\Support\Collection
    {
        $subjectsCollections = collect();

        /** @var Subject $subject */
        foreach ($subjects as $subject) {
            $subjectsCollections->add([
                'id' => $subject->getId(),
                'name' => $subject->getName()
            ]);
        }

        return $subjectsCollections;
    }
}