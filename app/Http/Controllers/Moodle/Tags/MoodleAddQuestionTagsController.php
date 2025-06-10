<?php

namespace App\Http\Controllers\Moodle\Tags;

use App\Http\Controllers\Controller;
use App\Services\Tags\MoodleAddQuestionTagsService;
use Illuminate\Http\Request;

class MoodleAddQuestionTagsController extends Controller
{
    protected MoodleAddQuestionTagsService $moodleAddQuestionTagService;

    public function __construct(MoodleAddQuestionTagsService $moodleGetTagService)
    {
        $this->moodleAddQuestionTagService = $moodleGetTagService;
    }

    // Add tags to a question
    public function addTagsToAQuestion(Request $request){

        $questionId = $request->input('questionid');
        $tagIds = $request->input('tagids', []);
        if (empty($questionId) || !is_numeric($questionId)) {
            return response()->json(['error' => 'Invalid question ID'], 400);
        }
        if (empty($tagIds) || !is_array($tagIds)) {
            return response()->json(['error' => 'Invalid tag IDs'], 400);
        }

        try{
            $tags = $this->moodleAddQuestionTagService->addTagsToQuestion($questionId, $tagIds);
            return response()->json($tags);
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
