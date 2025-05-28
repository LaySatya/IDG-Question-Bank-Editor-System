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

    // Get Quiz by course
    public function getQuizzesByCourseId(int $courseId)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'mod_quiz_get_quizzes_by_courses',
            'courseids' => [$courseId],
        ]);

        return $this->sendRequest($params);
    }

    // Get course contents
    public function getCourseContents(int $courseId)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_course_get_contents',
            'courseid' => $courseId,
        ]);

        return $this->sendRequest($params);
    }

    // Get quiz attempts
    public function getQuizAttempts(int $quizId)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'mod_quiz_get_quiz_attempts ',
            'quizid' => $quizId,
            // 'userid' => $userId,
        ]);

        return $this->sendRequest($params);
    }

   // get attempt review questions
    public function getAttemptReviewQuestions(int $attemptId)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'mod_quiz_get_attempt_review',
            'attemptid' => $attemptId,
        ]);

        return $this->sendRequest($params);
    }

    // get summarry questions -core_question_get_random_question_summaries
    public function getRandomQuestionSummaries(int $categoryId, int $limit)
    {
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_question_get_random_question_summaries',
            'categoryid' => $categoryId,
            'limit' => $limit,
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
