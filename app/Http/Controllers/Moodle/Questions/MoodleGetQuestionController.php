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
            $perPage = $request->input('per_page', 5);

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

    // Show all questions by tag with specific category
    public function showAllQuestionsByTagWithSpecificCategory(Request $request)
    {
        try {
            $tagIds = $request->input('tagids');
            $categoryId = $request->input('categoryid');

            if (empty($tagIds) || !is_array($tagIds)) {
                return response()->json(['error' => 'Invalid tag ids'], 400);
            }

            $questions = $this->moodleGetQuestionService->getAllQuestionsByTagWithSpecificCategory($categoryId, $tagIds);
            return response()->json($questions);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show all questions types
    public function showAllQuestionTypes(){
        try{
            $qtypes = $this->moodleGetQuestionService->getAllQuestionTypes();
            return response()->json($qtypes);
        }catch (\Throwable $e) {
            return response()->json([
                'error'=> 'Server error',
                'message'=> $e->getMessage(),
                ''=> $e->getTraceAsString()
            ] , 500);
        }
    }

    // Show questions by qtype
    public function showQuestionsByQtype(Request $request){
        try{
            $qtype = $request->input('qtypename');
            $categoryid = $request->input('categoryid');
            if (!$qtype) {
                return response()->json(['error' => 'Qtype is required'], 400);
            }

            $questions = $this->moodleGetQuestionService->getQuestionsByQtype($qtype, $categoryid);
            return response()->json($questions);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }

    }

    // Full filter questions
    public function fullFilterQuestions(Request $request){
        try{
            $tagIds = $request->input('tagids', []);
            $categoryid = $request->input('categoryid');
            $searchTerm = $request->input('searchterm');
            $qtype = $request->input('qtype');
            $status = $request->input('status');
            $createdBy = $request->input('createdby');
            $page = $request->input('page', 1);
            $perPage = $request->input('per_page', 5);
            if (!is_array($tagIds)) {
                return response()->json(['error' => 'Invalid tag ids, tagids must be in array'], 400);
            }

            $questions = $this->moodleGetQuestionService->filterQuestions($tagIds, $categoryid, $searchTerm, $qtype, $status, $createdBy, $page, $perPage);
            return response()->json($questions);

        }catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // show question versions history - track question versions
    public function trackQuestionVersions(Request $request){
        try{
            $qBankEntryId = $request->input('qbankentryid');
            if(empty($qBankEntryId)){
                return response()->json(['error' => 'Question Id is required'], 400);
            }
            $qVersions = $this->moodleGetQuestionService->trackQuestionVersions($qBankEntryId);

            return response()->json($qVersions);
        }catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

}
