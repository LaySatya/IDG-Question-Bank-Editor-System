<?php

namespace App\Services\Comments;
use App\Services\MoodleBaseService;


class MoodleActionQuestionCommentService extends MoodleBaseService
{
     // Get question comments to moodle
    public function getQuestionComments(int $questionId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_comments_by_questionid',
            'questionid' => $questionId,
        ]);
        return $this->sendRequest($params);
    }

    // Add comments
    public function addCommentQuestion(int $questionId, string $content, ?int $userId, ?int $format){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_add_comments_question',
            'questionid' => $questionId,
            'content' => $content,
            'userid' => $userId,
            'format' => $format
        ]);
        return $this->sendRequest($params);
    }

    // Remove comments
    public function removeCommentQuestion(int $questionId , int $commentId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_remove_comments_question',
            'questionid' => $questionId,
            'commentid' => $commentId,
        ]);
        return $this->sendRequest($params);
    }

}
