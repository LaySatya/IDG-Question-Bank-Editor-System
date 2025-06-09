<?php
// <!-- // https://elearning.cadt.edu.kh/webservice/rest/server.php?wsfunction=qbank_editquestion_set_status&moodlewsrestformat=json&wstoken=c1e3eeb3afcaa484dd4d3b0f7753df73&questionid=3167596&status=draft -->

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

}
