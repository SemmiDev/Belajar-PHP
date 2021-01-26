<?php

namespace Model {

    class Student
    {

        public function __construct(
            private ?int $id = null,
            private ?int $name = null,
            private ?int $nim = null,
            private ?int $email = null,
            private ?int $phone = null
        )
        {
        }

        /**
         * @return int|null
         */
        public function getId(): ?int
        {
            return $this->id;
        }

        /**
         * @param int|null $id
         */
        public function setId(?int $id): void
        {
            $this->id = $id;
        }

        /**
         * @return int|null
         */
        public function getName(): ?int
        {
            return $this->name;
        }

        /**
         * @param int|null $name
         */
        public function setName(?int $name): void
        {
            $this->name = $name;
        }

        /**
         * @return int|null
         */
        public function getNim(): ?int
        {
            return $this->nim;
        }

        /**
         * @param int|null $nim
         */
        public function setNim(?int $nim): void
        {
            $this->nim = $nim;
        }

        /**
         * @return int|null
         */
        public function getEmail(): ?int
        {
            return $this->email;
        }

        /**
         * @param int|null $email
         */
        public function setEmail(?int $email): void
        {
            $this->email = $email;
        }

        /**
         * @return int|null
         */
        public function getPhone(): ?int
        {
            return $this->phone;
        }

        /**
         * @param int|null $phone
         */
        public function setPhone(?int $phone): void
        {
            $this->phone = $phone;
        }
    }
}