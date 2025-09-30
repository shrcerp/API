<?php
    function update_notifications($data){
        global $con;
        $mrn  = $data['data_global']['mrn'];
        $ids = $data['notification_ids'] ?? '';
 
        
        if(empty($ids) || $ids == 'all'){
            $sql = "update mobile_notification a join video_patient b on b.id=a.user_id set a.status=2 where b.mrn_no='$mrn' or b.mrn_nodia='$mrn'";
        }else{
            $sql = "UPDATE mobile_notification SET status = 2 WHERE id IN ($ids)";
        }
              
        $query = mysqli_query($con, $sql);
        return [
            "code" => 102,
            "message" => "Notifications updated successfully"
        ];
    }
?>
