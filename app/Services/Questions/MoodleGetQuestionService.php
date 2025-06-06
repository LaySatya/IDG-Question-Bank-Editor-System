<?php
// <!-- // https://elearning.cadt.edu.kh/webservice/rest/server.php?wsfunction=qbank_editquestion_set_status&moodlewsrestformat=json&wstoken=c1e3eeb3afcaa484dd4d3b0f7753df73&questionid=3167596&status=draft -->

namespace App\Services\Questions;
use App\Services\MoodleBaseService;


class MoodleGetQuestionService extends MoodleBaseService
{

    // Get all questions from moodle
    public function getAllQuestions(){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_all_questions',
        ]);
        return $this->sendRequest($params);
    }

    // Get paginated questions from moodle - 10 questions per page
    public function getPaginatedQuestions(int $page = 1, int $perPage = 10){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_pagination_questions',
            'page' => $page,
            'perpage' => $perPage,
        ]);
        return $this->sendRequest($params);
    }
}
