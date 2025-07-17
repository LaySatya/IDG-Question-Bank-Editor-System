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
    public function fullEditQuestion(int $questionId, ?int $courseId)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_edit_form_moodle',
            'questionid' => $questionId,
            'courseid' => $courseId,
            // 'returnurl' => $returnUrl
        ]);
        return $this->sendRequest($params);
    }

    // Duplicate question Moodle Form
    public function duplicateQuestionMoodle(int $questionId, ?int $courseId)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_duplicate_form_moodle',
            'questionid' => $questionId,
            'courseid' => $courseId,
        ]);
        return $this->sendRequest($params);
    }

    // Bulk delete questions - All versions
    public function bulkDeleteQuestionsAllVersions(array $questionIds , bool $deleteAllVersions = true)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_bulk_delete_questions',
            'questionids' => $questionIds,
            'deleteallversions' => $deleteAllVersions,
        ]);

        return $this->sendRequest($params);
    }
    // Bulk delete questions - Specific versions
    public function bulkDeleteQuestionsSpecificVersions(array $questionIds , bool $deleteAllVersions = false)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_bulk_delete_questions',
            'questionids' => $questionIds,
            'deleteallversions' => $deleteAllVersions,
        ]);

        return $this->sendRequest($params);
    }
}
