<?php
// <!-- // https://elearning.cadt.edu.kh/webservice/rest/server.php?wsfunction=qbank_editquestion_set_status&moodlewsrestformat=json&wstoken=c1e3eeb3afcaa484dd4d3b0f7753df73&questionid=3167596&status=draft -->

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

    public function removeCommentQuestion(int $questionId , int $commentId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_remove_comments_question',
            'questionid' => $questionId,
            'commentid' => $commentId,
        ]);
        return $this->sendRequest($params);
    }

}
