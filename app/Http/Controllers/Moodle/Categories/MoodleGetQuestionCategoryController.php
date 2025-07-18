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

    // Show question categories by course
    public function showQuestionCategoriesByCourse(Request $request){
        try {
            $courseId = $request->input('courseid' , 0);

            // if(empty($courseId)){
            //     return response()->json([
            //         'error'=> 'Course Id is required!'
            //     ],404);
            // }

            $questionCategories = $this->moodleGetQuestionCategoryService->getQuestionCategoriesByCourse($courseId);

            return $questionCategories;
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
