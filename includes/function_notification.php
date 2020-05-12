<?PHP
function send_orderCompleted_notification($sendToWho){
    
     $tt = (array)$sendToWho;
     
    $fields = array(
        'app_id' => "ffaf2f6d-97f3-4a50-89f4-bfe3ccbe8fcf",
        'template_id' => "c8852e38-ce52-44a1-99b2-6a3d809ee476",
        'include_player_ids' => $tt,
        'data' => array(
            "foo" => "bar"
        ),
        //'contents' => $content,
        'web_buttons' => $hashes_array
    );

    $fields = json_encode($fields);
print("\nJSON sent:\n");
print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                               'Authorization: Basic YTVmN2Q4OWItODU4YS00MmIwLTg0NDAtNmQ4Mzk5MDJmZGZi'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$response = send_orderCompleted_notification($tt);
    $return["allresponses"] = $response;
    $return = json_encode( $return);
    
    print("\n\nJSON received:\n");
    print($return);
    print("\n");
?>