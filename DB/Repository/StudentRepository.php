<?php

namespace Repository {

    use Model\Student;

    interface StudentRepository
    {
        function insert(Student $student): Student;

        function findById(int $id): ?Student;

        function findAll(): array;
    }

    class StudentRepositoryImpl implements StudentRepository
    {

        public function __construct(private \PDO $connection){}

        function insert(Student $student): Student
        {
            $sql = "INSERT INTO students (name,nim,email,phone) VALUES (?,?,?,?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $student->getName(),
                $student->getNim(),
                $student->getEmail(),
                $student->getPhone()
            ]);

            $id = $this->connection->lastInsertId();
            $student->setId($id);
            return $student;
        }

        function deleteById(int $id) : bool
        {
            $sql = "DELETE FROM students WHERE id = ?";
            $statement = $this->connection->exec($sql);
            return true;
        }

        function findById(int $id): ?Student
        {
            $sql = "SELECT * FROM students WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute($id);

            if ($row = $statement->fetch()) {
                return new Student(
                    id: $row["id"],
                    name: $row["name"],
                    nim: $row["nim"],
                    email: $row["email"],
                    phone: $row["phone"]
                );
            } else {
                return null;
            }
        }

        function findAll(): array
        {
            $sql = "SELECT * FROM students";
            $statement = $this->connection->query($sql);
            $array = [];
            while ($row = $statement->fetch()) {
                $array = new Student(
                    id: $row["id"],
                    name: $row["name"],
                    nim: $row["nim"],
                    email: $row["email"],
                    phone: $row["phone"]
                );
            }
            return $array;
        }
    }
}