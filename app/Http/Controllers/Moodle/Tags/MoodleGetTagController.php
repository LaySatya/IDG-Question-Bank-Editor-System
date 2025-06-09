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
}
