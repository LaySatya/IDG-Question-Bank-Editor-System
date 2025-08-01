<?php

namespace App\Http\Controllers\Moodle\Questions;

use App\Http\Controllers\Controller;
use App\Services\Questions\MoodleUpdateQuestionService;
use Illuminate\Http\Request;

class MoodleUpdateQuestionController extends Controller
{

    protected MoodleUpdateQuestionService $moodleUpdateQuestionService;

    public function __construct(MoodleUpdateQuestionService $moodleUpdateQuestionService)
    {
        $this->moodleUpdateQuestionService = $moodleUpdateQuestionService;
    }


    // Update questions status - bulk edit status
    public function bulkUpdateQuestionStatus(Request $request)
    {
        try {
            $questionIds = $request->input('questionids', []);
            $newStatus = $request->input('newstatus');

            if (empty($questionIds) || !is_array($questionIds)) {
                return response()->json(['error' => 'Invalid question IDs'], 400);
            }

            if (!in_array($newStatus, ['ready', 'draft'])) {
                return response()->json(['error' => 'Invalid status'], 400);
            }

            $status = $this->moodleUpdateQuestionService->updateQuestionStatus($questionIds, $newStatus);

            return response()->json($status);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function setQuestionStatusByQuestionId(Request $request)
    {
        try {
            $questionId = $request->input('questionid');
            $status = $request->input('newstatus');

            if (empty($questionId) || !is_numeric($questionId)) {
                return response()->json(['error' => 'Invalid question ID'], 400);
            }

            if (!in_array($status, ['ready', 'draft'])) {
                return response()->json(['error' => 'Invalid status'], 400);
            }

            $result = $this->moodleUpdateQuestionService->editQuestionStatusByQuestionId($questionId, $status);

            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Bulk edit add tags to questions
    public function bulkEditAddQuestionsTags(Request $request)
    {
        try {
            $questionIds = $request->input('questionids', []);
            $tagIds = $request->input('tagids', []);

            if (empty($questionIds) || !is_array($questionIds)) {
                return response()->json(['error' => 'Invalid question IDs'], 400);
            }

            if (empty($tagIds) || !is_array($tagIds)) {
                return response()->json(['error' => 'Invalid tag IDs'], 400);
            }

            $result = $this->moodleUpdateQuestionService->bulkEditAddQuestionsTags($questionIds, $tagIds);

            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Bulk edit remove tags from questions
    public function bulkEditRemoveTagsFromQuestions(Request $request){
        try {
            $questionIds = $request->input('questionids', []);
            $tagIds = $request->input('tagids', []);

            if (empty($questionIds) || !is_array($questionIds)) {
                return response()->json(['error' => 'Invalid question IDs'], 400);
            }

            if (empty($tagIds) || !is_array($tagIds)) {
                return response()->json(['error' => 'Invalid tag IDs'], 400);
            }

            $result = $this->moodleUpdateQuestionService->bulkEditRemoveQuestionsTags($questionIds, $tagIds);

            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Update question name
    public function updateQuestionName(Request $request){
        try {
            $questionId = $request->input('questionid');
            $name = $request->input('name');
            $questionText = $request->input('questiontext');
            $questionTextFormat = $request->input('questiontextformat');
            $userId = $request->input('userid');

            if(empty($questionId) || empty($name) || empty($userId)){
                return response()->json(['error'=> 'questionid, name, userid are required!'], 400);
            }

            $success = $this->moodleUpdateQuestionService->editQuestionName($questionId, $name, $questionText, $questionTextFormat, $userId);
            return response()->json($success);

        } catch (\Throwable $e) {
             return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Full edit question Moodle form
    public function fullEditQuestionMoodleForm(Request $request){
        try {
            $questionId = $request->input('questionid');
            $courseId = $request->input('courseid');
            // $returnUrl = $request->input('returnurl');

            if(empty($questionId)){
                return response()->json(['error'=> 'questionid is required!'], 400);
            }

            $form = $this->moodleUpdateQuestionService->fullEditQuestion($questionId, $courseId);
            return response()->json($form);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Duplicate question Moodle form
    public function duplicateQuestionMoodleForm(Request $request){
        try {
            $questionId = $request->input('questionid');
            $courseId = $request->input('courseid');

            if(empty($questionId)){
                return response()->json(['error'=> 'questionid is required!'], 400);
            }

            $form = $this->moodleUpdateQuestionService->duplicateQuestionMoodle($questionId, $courseId);
            return response()->json($form);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Delete question - All versions
    public function deleteQuestionAllVersions(Request $request){
        try {
            $questionId = $request->input('questionid');
            $deleteallversions = $request->input('deleteallversions', true);

            if (empty($questionId) || !is_array($questionId)) {
                return response()->json(['error' => 'Invalid question ID'], 400);
            }

            $result = $this->moodleUpdateQuestionService->bulkDeleteQuestionsAllVersions($questionId, $deleteallversions);

            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

     // Delete question - All versions
    public function deleteQuestionsSpecificVersions(Request $request){
        try {
            $questionId = $request->input('questionid');
            $deleteallversions = $request->input('deleteallversions', false);

            if (empty($questionId) || !is_array($questionId)) {
                return response()->json(['error' => 'Invalid question ID'], 400);
            }

            $result = $this->moodleUpdateQuestionService->bulkDeleteQuestionsSpecificVersions($questionId, $deleteallversions);

            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Move question to another category
    public function moveQuestionToCategory(Request $request){
        try {
            $questionIds = $request->input('questionids', []);
            $sourceCategoryId = $request->input('sourcecategoryid');
            $targetCategoryId = $request->input('targetcategoryid');

            if (empty($questionIds) || !is_array($questionIds)) {
                return response()->json(['error' => 'Invalid question IDs'], 400);
            }

            if (empty($sourceCategoryId) || empty($targetCategoryId)) {
                return response()->json(['error' => 'Source and target category IDs are required'], 400);
            }

            $result = $this->moodleUpdateQuestionService->moveQuestionToCategory($questionIds, $sourceCategoryId, $targetCategoryId);

            return response()->json($result);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

}
