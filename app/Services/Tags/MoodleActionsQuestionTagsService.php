<?php

namespace App\Services\Tags;
use App\Services\MoodleBaseService;


class MoodleActionsQuestionTagsService extends MoodleBaseService
{

    // Add tags to a question to moodle
    public function addTagsToQuestion(int $questionId, array $tagIds){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_bulk_edit_questions_tags',
            'tagids' => $tagIds,
            'questionid' => $questionId,
            'operation' => 'add',
        ]);
        return $this->sendRequest($params);
    }

    // Remove tags from a question in moodle
    public function removeTagsFromQuestion(int $questionId, array $tagIds){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_bulk_edit_questions_tags',
            'tagids' => $tagIds,
            'questionid' => $questionId,
            'operation' => 'remove',
        ]);
        return $this->sendRequest($params);
    }

}
