<?php

//step1
$cSession = curl_init();

//step2
curl_setopt($cSession,CURLOPT_URL,"https://pixabay.com/api/?key=5589438-47a0bca778bf23fc2e8c5bf3e&q=otter&image_type=photo&orientation=horizontal&safesearch=true&per_page=9");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false);

//step3
$results = curl_exec($cSession);
$err = curl_error($cSession);

//step4
curl_close($cSession);

//step5
echo $results;

?>