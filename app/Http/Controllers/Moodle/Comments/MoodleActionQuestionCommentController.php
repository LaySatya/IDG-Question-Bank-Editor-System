<?php

namespace App\Http\Controllers\Moodle\Comments;

use App\Http\Controllers\Controller;
use App\Services\Comments\MoodleActionQuestionCommentService;
use Illuminate\Http\Request;

class MoodleActionQuestionCommentController extends Controller
{
    protected MoodleActionQuestionCommentService $moodleCommentService;

    public function __construct(MoodleActionQuestionCommentService $moodleCommentService)
    {
        $this->moodleCommentService = $moodleCommentService;
    }

    public function showQuestionComments(Request $request){

        try {
           $questionId = $request->input('questionid');

            if(empty($questionId)){
                return response()->json([
                    'error'=> 'Question Id is required!'
                ],404);
            }

            $comments = $this->moodleCommentService->getQuestionComments($questionId);

            return $comments;
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
    public function addCommentQuestion(Request $request){

        try {
           $questionId = $request->input('questionid');
           $content = $request->input('content');
           $userId = $request->input('userid');
           $format = $request->input('format');

            if(empty($questionId || empty($content))){
                return response()->json([
                    'error'=> 'Question Id and content of comment are required!'
                ],404);
            }

            $comments = $this->moodleCommentService->addCommentQuestion($questionId, $content, $userId, $format);

            return $comments;
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
    public function removeCommentQuestion(Request $request){

        try {
           $questionId = $request->input('questionid');
           $commentId = $request->input('commentid');


            if(empty($questionId || empty($commentId))){
                return response()->json([
                    'error'=> 'Question Id and comment Id are required!'
                ],404);
            }

            $comments = $this->moodleCommentService->removeCommentQuestion($questionId, $commentId);

            return $comments;
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
