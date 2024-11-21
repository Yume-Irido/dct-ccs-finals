INSERT INTO `students` (`id`, `student_id`, `first_name`, `last_name`) VALUES
(3, 'S003', 'Alice', 'Johnson'),
(4, 'S004', 'Bob', 'Smith'),
(5, 'S005', 'Charlie', 'Brown');


INSERT INTO `students_subjects` (`id`, `student_id`, `subject_id`, `grade`) VALUES
(5, 3, 1, 85.00),
(6, 4, 2, 90.50),
(7, 5, 3, 88.75);

INSERT INTO `subjects` (`id`, `subject_code`, `subject_name`) VALUES
(4, 'MATH', 'Mathematics'),
(5, 'SCI', 'Science'),
(6, 'ENG', 'English');


INSERT INTO `users` (`id`, `email`, `password`, `name`) VALUES
(3, 'alice@example.com', MD5('password123'), 'Alice Johnson'),
(4, 'bob@example.com', MD5('securePass456'), 'Bob Smith'),
(5, 'charlie@example.com', MD5('charlie789'), 'Charlie Brown');
