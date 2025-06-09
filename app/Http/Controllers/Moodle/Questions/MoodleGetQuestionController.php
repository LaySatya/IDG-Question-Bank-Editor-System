<?php

namespace App\Http\Controllers\Moodle\Questions;

use App\Services\Questions\MoodleGetQuestionService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MoodleGetQuestionController extends Controller
{
    protected MoodleGetQuestionService $moodleGetQuestionService;

    public function __construct(MoodleGetQuestionService $moodleGetQuestionService)
    {
        $this->moodleGetQuestionService = $moodleGetQuestionService;
    }


    // Show all questions
    public function showAllQuestions()
    {
        try {

            $questions = $this->moodleGetQuestionService->getAllQuestions();
            return $questions;

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show paginated questions
    public function showAllQuestionPaginations(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $perPage = $request->input('per_page', 10);
            // Paginate the questions
            $paginatedQuestions = $this->moodleGetQuestionService->getPaginatedQuestions($page, $perPage);

            return response()->json($paginatedQuestions);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show all questions by category id
    public function showAllQuestionsByCategory(Request $request){
        try {
            $categoryId = $request->input('categoryid');
            if (!$categoryId) {
                return response()->json(['error' => 'Category ID is required'], 400);
            }

            $questions = $this->moodleGetQuestionService->getAllQuestionsByCategoryId($categoryId);
            return response()->json($questions);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }


    // Show paginated questions by category
    public function showPaginationQuestionsByCategory(Request $request)
    {
        try {
            $categoryId = $request->input('categoryid');
            $page = $request->input('page', 1);
            $perPage = $request->input('per_page', 10);

            // Paginate the questions with category
            $paginatedQuestions = $this->moodleGetQuestionService->getPaginationQuestionsByCategory($categoryId, $page, $perPage);

            return response()->json($paginatedQuestions);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show question by question id
    public function showQuestionById(Request $request){
        try {
            $questionId = $request->input('questionid');
            if (!$questionId) {
                return response()->json(['error' => 'Question ID is required'], 400);
            }

            $question = $this->moodleGetQuestionService->getQuestionById($questionId);
            return response()->json($question);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
