<?php
function search_for_keywords($keyword,$faq){
$results = array(); // Array to store the matching results

foreach ($faq as $data) {
  $question = $data['question'];
  $answer = $data['answer'];
  $hashtag = $data['FAQS_hashtag'];

  // Check if the keyword exists in the question or answer
  if (stripos($question, $keyword) != false || stripos($answer, $keyword) != false || stripos($hashtag, $keyword) != false ) {
    $results[] = $data;
  }
}

// Display the matching results
if (count($results) > 0) {
  return $results;
} else {
  $error_message = 'No matching results found!';
  return $error_message;
}
}
?>