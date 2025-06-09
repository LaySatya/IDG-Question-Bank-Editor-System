<?php
// <!-- // https://elearning.cadt.edu.kh/webservice/rest/server.php?wsfunction=qbank_editquestion_set_status&moodlewsrestformat=json&wstoken=c1e3eeb3afcaa484dd4d3b0f7753df73&questionid=3167596&status=draft -->

namespace App\Services\Questions;
use App\Services\MoodleBaseService;


class MoodleUpdateQuestionService extends MoodleBaseService
{

    // Bulk Edit Status Quetions [ready, draft]
    public function updateQuestionStatus(array $questionIds, string $newstatus)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_bulk_edit_status_questions',
            'questionids' => $questionIds,
            'newstatus' => $newstatus,
        ]);

        return $this->sendRequest($params);
    }
}
