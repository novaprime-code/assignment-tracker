<?php
function get_courses()
{
    global $db;
    $query = 'SELECT * from courses ORDER BY courseID';
    $statement = $db->prepare($query);;
    $statement->execute();
    $courses = $statement->fetchAll();
    $statement->closeCursor();
    return $courses;
}
function get_courses_name($course_id)
{
    if (!$course_id) {
        return "All courses";
    }
    global $db;
    $query = 'SELECT * from courses where courseID = :course_id';
    $statement = $db->prepare($query);;
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
    $course_name = $course['courseName'];
    return $course_name;
}
function delete_course($course_id)
{
    global $db;
    $query = 'delete from courses where courseID=:course_id';
    $statement = $db->prepare($query);;
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $statement->closeCursor();
}
function add_course($course_name)
{
    global $db;
    $query = 'insert into courses(courseName) values (:courseName)';
    $statement = $db->prepare($query);;
    $statement->bindValue(':courseName', $course_name);
    $statement->execute();
    $statement->closeCursor();
}
