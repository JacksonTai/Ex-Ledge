<?php

namespace Model;

class Answer extends \config\DbConn
{
     private $postData = [];
     private $errMsg = [
          'title' => '',
          'content' => '',
          'tag' => '',
     ];

     protected function __construct($postData)
     {
          if (!empty($postData)) {
               $this->postData = $postData;
               $answerId = $this->createAnswer();
               header("location:../student/question.php?id=" . $postData['questionId'] . '#' . $answerId);
          }
     }

     private function createAnswer()
     {
          $answerId = uniqid('A');
          $sql = "INSERT INTO answer (answer_id, question_id, `user_id`, content)
                  VALUES (?, ?, ?, ?);";

          $this->executeQuery($sql, [
               $answerId,
               $this->postData['questionId'],
               $this->postData['userId'],
               $this->postData['ansContent']
          ]);

          return $answerId;
     }

     protected function readAnswer($criteria = null, $status = null)
     {
          if ($criteria) {
               if ($criteria[0] == 'Q') {

                    // Get accepted or rejected answer.
                    if ($status) {
                         $sql = "SELECT * FROM answer WHERE question_id = ?
                                   AND `status` = ?;";
                         $stmt = $this->executeQuery($sql, [$criteria, $status]);
                         return $stmt->fetch();
                    }

                    // Get all answer of that specific question.
                    $sql = "SELECT * FROM answer WHERE question_id = ?;";
                    $stmt = $this->executeQuery($sql, [$criteria]);
                    return $stmt->fetchAll();
               }

               // Get specific answer based on the given answer ID.
               if ($criteria[0] == 'A') {
                    $sql = "SELECT * FROM answer WHERE answer_id = ?;";
                    $stmt = $this->executeQuery($sql, [$criteria]);
                    return $stmt->fetch();
               }
          }
     }

     protected function getAnswerCount($criteria)
     {
          if ($criteria && $criteria[0] == 'Q') {
               $sql = "SELECT COUNT(answer_id) FROM answer a
                         WHERE question_id = ?;";
               $stmt = $this->executeQuery($sql, [$criteria]);
               $result = $stmt->fetch();
               return $result['COUNT(answer_id)'];
          }
     }

     protected function updateAnswerStatus($answerId)
     {
          $vote = new \Controller\Vote();

          // Get accepting answer's question.
          $answer = $this->readAnswer($answerId);

          $acceptedAns = $this->readAnswer($answer['question_id'], 1);

          // Check if there's any exsisting answer.
          if ($acceptedAns) {
               // If the user accept the same existing answer. 
               if ($acceptedAns['answer_id'] == $answerId) {
                    $sql = "UPDATE answer SET `status` = ?, `point` = `point` + ?
                              WHERE answer_id = ?;";
                    $this->executeQuery($sql, [0, -2, $answerId]);
                    $vote->updatePoint($answerId);
               }

               // If the user accept another exsisting answer.
               if ($acceptedAns['answer_id'] != $answerId) {
                    $sql = "UPDATE answer SET `status` = ?, `point` = `point` + ?
                              WHERE answer_id = ?;";
                    $this->executeQuery($sql, [0, -2, $acceptedAns['answer_id']]);
                    $vote->updatePoint($acceptedAns['answer_id']);
               }
          }

          // Only add the accepting answer point if it's not the previously accepted answer.
          if (!$acceptedAns || $acceptedAns['answer_id'] != $answerId) {
               $sql = "UPDATE answer SET `status` = ?, `point` = `point` + ?
                         WHERE answer_id = ?;";

               // Status with value of 1 will become true in boolean and vice versa for 0.
               $this->executeQuery($sql, $answer['status'] ?  [0, 2, $answerId] : [1, 2, $answerId]);
               $vote->updatePoint($answerId);
          }
     }
}
