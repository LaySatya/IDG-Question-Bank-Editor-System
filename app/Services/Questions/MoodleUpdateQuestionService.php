<?php

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

    // Bulk Edit Question Tags - remove tags from questions
    public function bulkEditRemoveQuestionsTags(array $questionIds, array $tagIds)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_bulk_edit_questions_tags',
            'questionids' => $questionIds,
            'tagids' => $tagIds,
            'operation' => 'remove',
        ]);

        return $this->sendRequest($params);
    }

    // Update Question Name
    public function editQuestionName(string $questionId, string $name, ?string $questionText, ?int $questionTextFormat, $userId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_update_question_name',
            'questionid' => $questionId,
            'name' => $name,
            'questiontext' =>  $questionText,
            'questiontextformat'=> $questionTextFormat,
            'userid' => $userId
        ]);

        return $this->sendRequest($params);
    }

    // Full Edit Question Moodle Form
    public function fullEditQuestion(int $questionId, int $courseId, string $returnUrl)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_edit_form_moodle',
            'questionid' => $questionId,
            'courseid' => $courseId,
            'returnurl' => $returnUrl
        ]);
        return $this->sendRequest($params);
    }
}
