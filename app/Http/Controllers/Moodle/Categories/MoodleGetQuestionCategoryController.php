<?php

namespace App\Http\Controllers\Moodle\Categories;

use App\Http\Controllers\Controller;
use App\Services\Categories\MoodleGetQuestionCategoryService;
use Illuminate\Http\Request;

class MoodleGetQuestionCategoryController extends Controller
{

    protected MoodleGetQuestionCategoryService $moodleGetQuestionCategoryService;

    public function __construct(MoodleGetQuestionCategoryService $moodleGetQuestionCategoryService)
    {
        $this->moodleGetQuestionCategoryService = $moodleGetQuestionCategoryService;
    }


    // Show all question categories
    public function showAllQuestionCategories(Request $request)
    {
        try {
            $categories = $this->moodleGetQuestionCategoryService->getAllQuestionCategories();
            return $categories;
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
