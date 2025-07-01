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
     public function getPaginatedQuestions(int $page = 1, int $perPage): array
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_pagination_questions',
            'page' => $page,
            'perpage' => $perPage,
        ]);

        return $this->sendRequest($params);
    }

    // Get all questions by category id from moodle
    public function getAllQuestionsByCategoryId(int $categoryId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_questions_by_category',
            'categoryid' => $categoryId,
        ]);
        return $this->sendRequest($params);
    }

    // Get questions by category id from moodle
    public function getQuestionsByCategoryId(int $categoryId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_pagination_questions_by_category',
            'categoryid' => $categoryId,
        ]);
        return $this->sendRequest($params);
    }

    // Get paginated questions by category id from moodle
    public function getPaginationQuestionsByCategory(?int $categoryId, int $page = 1, int $perPage = 10){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_pagination_questions_by_category',
            'categoryid' => $categoryId,
            'page' => $page,
            'perpage' => $perPage,
        ]);
        return $this->sendRequest($params);
    }

    // Get question by id from moodle
    public function getQuestionById(int $questionId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_question_by_questionid',
            'questionid' => $questionId,
        ]);
        return $this->sendRequest($params);
    }

    // Get all questions by tag and category id from moodle
    public function getAllQuestionsByTagWithSpecificCategory(?int $categoryId, array $tagId) {

        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_questions_by_tags_with_specific_category',
            'tagids' => $tagId,
            'categoryid' => $categoryId,
        ]);
        return $this->sendRequest($params);
    }

    // Get all question types
    public function getAllQuestionTypes(){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_question_types',
        ]);
        return $this->sendRequest($params);
    }

    // Get questions by qtype from moodle
    public function getQuestionsByQtype($qtype, $categoryid){
        $params = array_merge($this->getBaseParams(), [
               'wsfunction' => 'local_idgqbank_get_questions_by_qtype',
               'qtypename' => $qtype,
               'categoryid' => $categoryid
        ]);
        return $this->sendRequest($params);
    }

    // Filter questions by category, qtext, qname, tags, status, qtype, user-who-created-questions from moodle
    public function filterQuestions(?array $tagids, ?int $categoryid, ?string $searchterm, ?string $qtype, ?string $status, ?int $createdby, ?int $page, ?int $perPage){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_filter_questions',
            'tagids' => $tagids,
            'categoryid' => $categoryid,
            'searchterm' => $searchterm,
            'qtype' => $qtype,
            'status' => $status,
            'createdby' => $createdby,
            'page' => $page,
            'perpage'=> $perPage
        ]);
        return $this->sendRequest($params);
    }

    // Get question versions history
    public function trackQuestionVersions(int $qBankEntryId){
        $params = array_merge($this->getBaseParams(), [
               'wsfunction' => 'local_idgqbank_track_question_versions',
               'qbankentryid' => $qBankEntryId
        ]);
        return $this->sendRequest($params);
    }

    // Preview question
    public function previewQuestionMode(int $questionId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_preview_question',
            'questionid' => $questionId,
        ]);
        return $this->sendRequest($params);
    }


}
