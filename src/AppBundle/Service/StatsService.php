<?php

namespace AppBundle\Service;

use AppBundle\AppBundle;
use AppBundle\Entity\Survey;

/**
 * Class StatsService
 *
 * @package AppBundle\Service
 */
class StatsService
{
    /**
     * returns statistics for corresponding Survey (percentage of answers to every question)
     *
     * @param Survey $survey
     * @return array
     */
    public function getStats(Survey $survey) {
        $questions = $survey->getQuestions()->toArray();
        $questions_new = [];
        $new_arr = [];

        foreach ($questions as $key => $value) {
            $questions_new[$value->getQuestion()] = $value->getAnswers()->toArray();
        }

        foreach ($questions_new as $key => $value) {
            for($i = 0; $i < count($value); $i++) {
                $questions_new[$key][$i] = $value[$i]->getAnswer();
            }
        }

        foreach ($questions_new as $key => $value) {
            $new_arr[$key] = array_count_values($value);
            arsort($new_arr[$key]);

        }

        foreach ($new_arr as $key => $value) {
            $total = array_sum($new_arr[$key]);
            foreach ($value as $key1 => $value1) {
                $new_arr[$key][$key1] = round($value1/$total * 100, 2);
            }
        }

        return $new_arr;
    }

}