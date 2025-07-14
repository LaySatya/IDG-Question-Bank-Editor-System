<?php

namespace App\Services\Tags;
use App\Services\MoodleBaseService;


class MoodleGetTagService extends MoodleBaseService
{

    // Get all tags from moodle
    public function getAllTags(){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_all_tags',
        ]);
        return $this->sendRequest($params);
    }

    // Get tag by tag id from moodle
    public function getTagById(array $tagIds){
        $tags = array_map(fn($id) => ['id' => $id], $tagIds); // Wrap as expected

        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_tag_get_tags',
            'tags' => $tags,
        ]);
        return $this->sendRequest($params);
    }

    // Get tags by question id from moodle
    public function getTagsByQuestionId(int $questionId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_tags_by_question_id',
            'questionid' => $questionId,
        ]);
        return $this->sendRequest($params);
    }
}
