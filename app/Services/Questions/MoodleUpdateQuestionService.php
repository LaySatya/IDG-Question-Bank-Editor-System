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

    // Edit Question Status By Specific Question ID
    public function editQuestionStatusByQuestionId(int $questionId, string $status)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'qbank_editquestion_set_status',
            'questionid' => $questionId,
            'status' => $status,
        ]);

        return $this->sendRequest($params);
    }

    // Bulk Edit Question Tags - add tags to questions
    public function bulkEditAddQuestionsTags(array $questionIds, array $tagIds)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_bulk_edit_questions_tags',
            'questionids' => $questionIds,
            'tagids' => $tagIds,
            'operation' => 'add',
        ]);

        return $this->sendRequest($params);
    }
}
