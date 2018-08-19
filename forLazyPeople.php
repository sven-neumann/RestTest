<?php


// Seed authors
// add 3 authors
for ($i = 1; $i <= 3; $i++) {


    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8000",
        CURLOPT_URL => "http://127.0.0.1:8000/v1/author/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "name=AuthorName" . $i . "&age=" . (50 + $i),
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "rttoken: RestTest"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }
}


if (!$err) {
    echo "seeded 3 Authors\n";
}

//Seed books


for ($i = 1; $i <= 3; $i++) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8000",
        CURLOPT_URL => "http://127.0.0.1:8000/v1/book/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "name=BookName1-" . $i . "&genre=science&author_id=" . $i,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "rttoken: RestTest"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }


    //seed another book
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8000",
        CURLOPT_URL => "http://127.0.0.1:8000/v1/book/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "name=BookName2-" . $i . "&genre=fun&author_id=" . $i,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            "rttoken: RestTest"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }


}


if (!$err) {
    echo "seeded 6 books\n";
}

