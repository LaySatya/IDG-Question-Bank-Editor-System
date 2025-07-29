<?php

namespace App\Services\Questions;
use App\Services\MoodleBaseService;


class MoodlePreviewQuestionService extends MoodleBaseService
{
    // Preview question
    public function previewQuestionMode(int $questionId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_preview_question',
            'questionid' => $questionId,
        ]);
        return $this->sendRequest($params);
    }

    // Preview question mode in real moodle
    public function previewMoodleQuestionMode(int $questionId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_preview_question_via_url',
            'questionid' => $questionId,
        ]);
        return $this->sendRequest($params);
    }

    // Preview all questions in a category
    public function previewQuestionsInCategory(int $categoryId, ?int $start){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_multi_preview',
            'categoryid' => $categoryId,
            'start' => $start
        ]);
        return $this->sendRequest($params);
    }

     // Import question mode in real moodle
    public function importQuestions(int $categoryId, int $contextId, ?int $courseId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_import_form_moodle',
            'categoryid' => $categoryId,
            'contextid' => $contextId,
            'cmid' => $courseId
        ]);
        return $this->sendRequest($params);
    }

    // Export question mode in real moodle
   public function exportQuestions(int $categoryId, int $contextId, ?int $courseId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_export',
            'categoryid' => $categoryId,
            'contextid' => $contextId,
            'cmid' => $courseId
        ]);
        return $this->sendRequest($params);
    }

    // Question overview in category
    public function questionOverview(int $categoryId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_question_overview',
            'categoryid' => $categoryId,
        ]);
        return $this->sendRequest($params);
    }


    // Add new question in real moodle
    public function addNewQuestion(string $qtype, int $categoryId, int $contextId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_create_question',
            'qtype' => $qtype,
            'categoryid' => $categoryId,
            'contextid' => $contextId
        ]);

        return $this->sendRequest($params);
    }

}
