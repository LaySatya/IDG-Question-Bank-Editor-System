<?php

namespace App\Http\Controllers\Moodle;

use App\Services\MoodleQuestionService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MoodleQuestionController extends Controller
{
    // show all categories - Institute of Digital Governance
    public function showCategories(MoodleQuestionService $moodle){
        try {
            $categories = $moodle->getCategories();
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve categories: ' . $e->getMessage()], 500);
        }
    }


    // show courses by fields
    public function showCoursesByFields(Request $request, MoodleQuestionService $moodle){
        $field = $request->input('field');
        $value = $request->input('value');

        if (!$field || !$value) {
            return response()->json(['error' => 'Field and value are required'], 400);
        }

        try {
            $courses = $moodle->getCoursesByFields($field, $value);
            return response()->json($courses);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve courses: ' . $e->getMessage()], 500);
        }
    }


    // Get Quizzes by Course ID
    public function showQuestionsByFields(Request $request, MoodleQuestionService $moodle){
        $courseId = $request->input('courseid');

        if (!$courseId) {
            return response()->json(['error' => 'Course ID is required'], 400);
        }

        try {
            $quizzes = $moodle->getQuizzesByCourseId($courseId);
            return response()->json($quizzes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve quizzes: ' . $e->getMessage()], 500);
        }
    }

    // Get Course Contents
    public function showCourseContents(Request $request, MoodleQuestionService $moodle){
        $courseId = $request->input('courseid');

        if (!$courseId) {
            return response()->json(['error' => 'Course ID is required'], 400);
        }

        try {
            $contents = $moodle->getCourseContents($courseId);
            return response()->json($contents);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve course contents: ' . $e->getMessage()], 500);
        }
    }

    // Get Quiz Attempts
    public function showQuizAttempts(Request $request, MoodleQuestionService $moodle){
        $quizId = $request->input('quizid');

        if (!$quizId) {
            return response()->json(['error' => 'Quiz ID is required'], 400);
        }

        try {
            $attempts = $moodle->getQuizAttempts($quizId);
            return response()->json($attempts);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve quiz attempts: ' . $e->getMessage()], 500);
        }
    }

    // view attempts review questions
    public function showAttemptReviewQuestions(Request $request, MoodleQuestionService $moodle){
        $attemptId = $request->input('attemptid');

        if (!$attemptId) {
            return response()->json(['error' => 'Attempt ID is required'], 400);
        }

        try {
            $questions = $moodle->getAttemptReviewQuestions($attemptId);
            return response()->json($questions);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve attempt review questions: ' . $e->getMessage()], 500);
        }
    }

    // get summary of questions
    public function showSummaryQuestions(Request $request, MoodleQuestionService $moodle){
        $categoryId = $request->input('categoryid');
        $limit = $request->input('limit'); // Default to 10 if not provided
        if (!$categoryId) {
            return response()->json(['error' => 'Category ID are required'], 400);
        }
        try {
            $summary = $moodle->getRandomQuestionSummaries( $categoryId, $limit);
            return response()->json($summary);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve question summary: ' . $e->getMessage()], 500);
        }

    }

    // Set Question Status By Specific Question ID
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



    // Get user to login by this ws function core_user_get_users_by_field
    public function showUserByField(Request $request, MoodleQuestionService $moodle){
        $field = $request->input('field');
        $value = $request->input('value');

        if (!$field || !$value) {
            return response()->json(['error' => 'Field and value are required'], 400);
        }

        try {
            $user = $moodle->getUsersByField($field, $value);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve user: ' . $e->getMessage()], 500);
        }
    }
}
