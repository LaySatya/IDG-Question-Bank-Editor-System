<?php

namespace App\Http\Controllers\Moodle\Questions;

use App\Http\Controllers\Controller;
use App\Services\Questions\MoodlePreviewQuestionService;
use Illuminate\Http\Request;

class MoodlePreviewQuestionController extends Controller
{
    //
     protected MoodlePreviewQuestionService $moodlePreviewQuestionService;

    public function __construct(MoodlePreviewQuestionService $moodlePreviewQuestionService)
    {
        $this->moodlePreviewQuestionService = $moodlePreviewQuestionService;
    }


    // Preview question
    public function previewQuestion(Request $request){
        try {
            $questionId = $request->input('questionid');
            if (!$questionId) {
                return response()->json(['error' => 'Question ID is required'], 400);
            }

            $preview = $this->moodlePreviewQuestionService->previewQuestionMode($questionId);
            return response()->json($preview);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Preview question mode in real moodle
    public function previewMoodleQuestionMode(Request $request){
        try {
            $questionId = $request->input('questionid');
            if (!$questionId) {
                return response()->json(['error' => 'Question ID is required'], 400);
            }

            $preview = $this->moodlePreviewQuestionService->previewMoodleQuestionMode($questionId);
            return response()->json($preview);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Preview question in a category in real moodle
    public function previewQuestionsInCategory(Request $request){
        try {
            $categoryId = $request->input('categoryid');
            $start = $request->input('start', 0);
            if (!$categoryId) {
                return response()->json(['error' => 'Category ID is required'], 400);
            }

            $preview = $this->moodlePreviewQuestionService->previewQuestionsInCategory($categoryId, $start);
            return response()->json($preview);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Import question mode in real moodle
    public function importQuestionsMoodle(Request $request){
        try {
            $categoryId = $request->input('categoryid');
            $contextId = $request->input('contextid');
            $courseId = $request->input('courseid' , 0);

            if (!$categoryId & !$contextId) {
                return response()->json(['error' => 'Category and context Id are required'], 400);
            }

            $import = $this->moodlePreviewQuestionService->importQuestions($categoryId, $contextId, $courseId);
            return response()->json($import);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Export question mode in real moodle
    public function exportQuestionsMoodle(Request $request){
        try {
            $categoryId = $request->input('categoryid');
            $contextId = $request->input('contextid');
            $courseId = $request->input('courseid', 0);

            if (!$categoryId || !$contextId) {
                return response()->json(['error' => 'Category and context Id are required'], 400);
            }

            $export = $this->moodlePreviewQuestionService->exportQuestions($categoryId, $contextId, $courseId);
            return response()->json($export);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Question overview in category
    public function questionOverview(Request $request){
        try {
            $categoryId = $request->input('categoryid');

            if (!$categoryId) {
                return response()->json(['error' => 'Category Id is required'], 400);
            }

            $import = $this->moodlePreviewQuestionService->questionOverview($categoryId);
            return response()->json($import);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

}
