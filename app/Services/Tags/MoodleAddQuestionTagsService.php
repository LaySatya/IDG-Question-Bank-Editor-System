<?php
// <!-- // https://elearning.cadt.edu.kh/webservice/rest/server.php?wsfunction=qbank_editquestion_set_status&moodlewsrestformat=json&wstoken=c1e3eeb3afcaa484dd4d3b0f7753df73&questionid=3167596&status=draft -->

namespace App\Services\Tags;
use App\Services\MoodleBaseService;


class MoodleAddQuestionTagsService extends MoodleBaseService
{

    // Add tags to a question to moodle
    public function addTagsToQuestion(int $questionId, array $tagIds){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_add_tags_to_question',
            'tagids' => $tagIds,
            'questionid' => $questionId,
        ]);
        return $this->sendRequest($params);
    }

}
