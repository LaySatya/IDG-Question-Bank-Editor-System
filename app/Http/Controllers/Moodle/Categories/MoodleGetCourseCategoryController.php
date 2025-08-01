<?php

namespace App\Http\Controllers\Moodle\Categories;

use App\Http\Controllers\Controller;
use App\Services\Categories\MoodleGetCourseCategoryService;
use Illuminate\Http\Request;

class MoodleGetCourseCategoryController extends Controller
{
    protected MoodleGetCourseCategoryService $moodleGetCourseCategoryService;

    public function __construct(MoodleGetCourseCategoryService $moodleGetCourseCategoryService)
    {
        $this->moodleGetCourseCategoryService = $moodleGetCourseCategoryService;
    }


    // Show all course categories
    public function showAllCourseCategories(Request $request)
    {
        try {
            $categories = $this->moodleGetCourseCategoryService->getAllCourseCategories();
            return $categories;
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show courses by category
    public function showCoursesByCategory(Request $request){
        try{
            $categoryId = $request->input('categoryid');
            if(empty($categoryId)){
                return response()->json([
                    'message' => 'Category id is required!',
                ] ,404);
            }
            $courses = $this->moodleGetCourseCategoryService->getCoursesByCategory($categoryId);
            return $courses;

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Get all courses from Moodle - Pagination
    public function showAllCourses(Request $request){
        try{
            $page = $request->input('page' , 0);
            $perPage = $request->input('perpage', 10);

            $courses = $this->moodleGetCourseCategoryService->getPaginationCourses($page , $perPage);
            return $courses;

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
    // Get all courses from Moodle - Pagination
    public function searchCourses(Request $request){
        try{
            $criteriaName = $request->input('criterianame', 'search');
            $criteriaValue = $request->input('criteriavalue');
            if(empty($criteriaValue)){
                return response()->json([
                    'message' => 'Value is required!',
                ] ,404);
            }
            $page = $request->input('page' , 0);
            $perPage = $request->input('perpage', 10);

            $courses = $this->moodleGetCourseCategoryService->searchCourses($criteriaName , $criteriaValue,$page , $perPage , );
            return $courses;

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
