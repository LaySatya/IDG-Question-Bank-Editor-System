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
}
