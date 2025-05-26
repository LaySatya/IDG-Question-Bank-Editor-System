<?php

namespace App\Http\Controllers\Moodle;

use App\Services\MoodleQuestionService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MoodleQuestionController extends Controller
{
    public function setQuestionStatusById(Request $request, MoodleQuestionService $moodle){
        $questionId = $request->input('questionid');
        $status = $request->input('status');

        if (!$questionId || !$status) {
            return response()->json(['error' => 'Question ID and status are required'], 400);
        }

        try {
            $result = $moodle->editQuestionStatusById($questionId, $status);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update question status: ' . $e->getMessage()], 500);
        }
    }
}
