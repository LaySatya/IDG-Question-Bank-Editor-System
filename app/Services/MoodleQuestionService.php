<?php
// <!-- // https://elearning.cadt.edu.kh/webservice/rest/server.php?wsfunction=qbank_editquestion_set_status&moodlewsrestformat=json&wstoken=c1e3eeb3afcaa484dd4d3b0f7753df73&questionid=3167596&status=draft -->

namespace App\Services;
use App\Services\MoodleBaseService;


class MoodleQuestionService extends MoodleBaseService
{
    // Set Question Status By Specific Question ID
    public function editQuestionStatusById(int $questionId, string $status)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'qbank_editquestion_set_status',
            'questionid' => $questionId,
            'status' => $status,
        ]);

        return $this->sendRequest($params);
    }
}
