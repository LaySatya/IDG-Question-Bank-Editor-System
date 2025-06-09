<?php

namespace App\Http\Controllers\Moodle\Tags;

use App\Http\Controllers\Controller;
use App\Services\Tags\MoodleGetTagService;
use Illuminate\Http\Request;

class MoodleGetTagController extends Controller
{
    //
    protected MoodleGetTagService $moodleGetTagService;

    public function __construct(MoodleGetTagService $moodleGetTagService)
    {
        $this->moodleGetTagService = $moodleGetTagService;
    }

    // Show all tags
    public function showAllTags(){
        try{
            $tags = $this->moodleGetTagService->getAllTags();
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

    // Show tag by tags id
    public function showTagById(Request $request)
    {
        try {
            $tagIds = $request->input('tags.id', []);
            if (empty($tagIds) || !is_array($tagIds)) {
                return response()->json(['error' => 'Invalid tag ID'], 400);
            }

            $tag = $this->moodleGetTagService->getTagById($tagIds);
            return response()->json($tag);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show tags by question id
    public function showTagsByQuestionId(Request $request){
        try {
            $questionId = $request->input('questionid');
            if (empty($questionId) || !is_numeric($questionId)) {
                return response()->json(['error' => 'Invalid question ID'], 400);
            }

            $tags = $this->moodleGetTagService->getTagsByQuestionId($questionId);
            return response()->json($tags);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }


}
