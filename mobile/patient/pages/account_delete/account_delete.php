<?php
function account_delete($data){
    
    global $con;
    $id = $data['data_global']['patient_id']; 
    
    $sql = "UPDATE video_patient SET status=2 WHERE id=$id";
    $query = mysqli_query($con, $sql);

    if ($query && mysqli_affected_rows($con) > 0) {
        return [
            "code" => "101",
            "message" => "Account deleted successfully"
        ];
    } else {
        return [
            "code" => "102",
            "message" => "Error deleting account or account not found"
        ];
    }
}
?>
