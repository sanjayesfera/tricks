<?php

include './config.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if (!empty($action)) {

    if ($action == "create") { // insert

        $name = isset($_REQUEST['txtname']) ? $_REQUEST['txtname'] : '';
        $email = isset($_REQUEST['txtemail']) ? $_REQUEST['txtemail'] : '';
        $roll = isset($_REQUEST['txtroll']) ? $_REQUEST['txtroll'] : '';

        $insertQuery = "Insert into students (name,email,roll_no) Values ('" . $name . "','" . $email . "'," . $roll . ")";

        if ($connection->query($insertQuery) === true) {

            echo json_encode(array("status" => 1, "message" => "New student record created"));
        } else {

            echo json_encode(array("status" => 0, "message" => "Failed to create student"));
        }
    } elseif ($action == "update") { // update

        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $name = isset($_REQUEST['txtname']) ? $_REQUEST['txtname'] : '';
        $email = isset($_REQUEST['txtemail']) ? $_REQUEST['txtemail'] : '';
        $roll = isset($_REQUEST['txtroll']) ? $_REQUEST['txtroll'] : '';

        $updateQuery = "Update students Set name = '" . $name . "', email = '" . $email . "', roll_no = " . $roll . " WHERE id = " . $id;

        if ($connection->query($updateQuery) === true) {

            echo json_encode(array("status" => 1, "message" => "Record updated successfully"));
        } else {

            echo json_encode(array("status" => 0, "message" => "Failed to update record"));
        }
    } elseif ($action == "delete") { // delete

        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

        $deleteQuery = "DELETE from students WHERE id = " . $id;

        if ($connection->query($deleteQuery) === true) {

            echo json_encode(array("status" => 1, "message" => "Record deleted successfully"));
        } else {

            echo json_encode(array("status" => 0, "message" => "Failed to delete record"));
        }
    } elseif ($action == "show") { // show

        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

        if (!empty($id)) { // for specific ID

            $showQuery = "Select * from students WHERE id = " . $id;
        } else {  // show all

            $showQuery = "Select * from students";
        }

        $result = $connection->query($showQuery);

        if ($result->num_rows > 0) {

            $records = [];
            
            while ($row = $result->fetch_assoc()) {
                
                $records[] = $row;
            }

            echo json_encode(array("status" => 1, "message" => "data found", "records" => $records));
        } else {

            echo json_encode(array("status" => 0, "message" => "No data found"));
        }
    }

    die();
}
