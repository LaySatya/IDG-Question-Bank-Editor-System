<?php

namespace App\Services\Categories;
use App\Services\MoodleBaseService;


class MoodleGetQuestionCategoryService extends MoodleBaseService
{

    // Get all question categories from moodle
    public function getAllQuestionCategories(){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_question_categories',
        ]);
        return $this->sendRequest($params);
    }

    //local_idgqbank_get_question_categories_by_course_category


}
