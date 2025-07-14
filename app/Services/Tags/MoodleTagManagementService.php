<?php

namespace App\Services\Tags;
use App\Services\MoodleBaseService;


class MoodleTagManagementService extends MoodleBaseService
{

    // Get all tags from moodle
    public function getAllTags($page, $perPage = 10){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_manage_get_tags',
            'page' => $page,
            'perpage' => $perPage
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
}
