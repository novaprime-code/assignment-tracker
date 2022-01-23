<?php 
      function get_assignments_by_course($course_id) {
        global $db;
        if ($course_id) {
            $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments AS A LEFT JOIN courses AS C ON A.courseID = C.courseID WHERE A.courseID = :course_id ORDER BY ID';
        }
         else {
            $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments AS A LEFT JOIN courses AS C ON A.courseID = C.courseID ORDER BY C.courseID';
        }
        // if ($course_id) {
        //     $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID WHERE A.courseID = :course_id ORDER BY ID';
        // } else {
        //     $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID ORDER BY C.courseID';
        // }
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindParam(':course_id', $course_id);
        // echo $statement;
        $statement->execute();
        $assignments = $statement->fetchAll();
        $statement->closeCursor();
        return $assignments;
    }
    function delete_assignments($assignment_id){
        global $db;
        $query='DELETE FROM assignments where ID=:assign_id';
        $statement = $db->prepare($query);;
        $statement->bindValue(':assign_id',$assignment_id);
        $statement->execute();
        // $assignments = $statement->fetchAll();
        $statement->closeCursor();
    }
    function add_assignments($course_id,$description){
        global $db;
        $query='INSERT INTO assignments(Description,courseID) values(:descr,:courseID)';
        $statement = $db->prepare($query);;
        $statement->bindValue(':descr',$description);
        $statement->bindValue(':courseID',$course_id);
        $statement->execute();
        $statement->closeCursor();
    }