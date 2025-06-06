<?php
// <!-- // https://elearning.cadt.edu.kh/webservice/rest/server.php?wsfunction=qbank_editquestion_set_status&moodlewsrestformat=json&wstoken=c1e3eeb3afcaa484dd4d3b0f7753df73&questionid=3167596&status=draft -->

namespace App\Services;
use App\Services\MoodleBaseService;


class MoodleQuestionService extends MoodleBaseService
{

    // Get All Categories
    public function getCategories(){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_course_get_categories',
        ]);
        return $this->sendRequest($params);
    }

    // Get Courses By Category
    public function getCoursesByFields($field , $value){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_course_get_courses_by_field',
            'field' => $field,
            'value' => $value,
        ]);
        return $this->sendRequest($params);
    }


    // Set Question Status By Specific Question ID
    public function editQuestionStatusById(int $questionId, string $status)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'qbank_editquestion_set_status',
            'questionid' => $questionId,
            'status' => $status,
        ]);

        return $this->sendRequest($params);
    }

    // get user to login by this ws function core_user_get_users_by_field
    public function getUsersByField(string $field, string $value)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_user_get_users_by_field',
            'field' => $field,
            'values' => [$value],
        ]);

        return $this->sendRequest($params);
    }
}
