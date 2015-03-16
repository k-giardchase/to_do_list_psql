<?php
    class Task
    {

        private $description;

        function __construct($description)
        {
            $this->description = $descrition;
        }

        function setDescription($new_description)
        {
            $this->description = (string) $new_description;
        }

        function getDescription()
        {
            return $this->description;
        }

        function save()
        {
            array_push($_SESSION['list_of_taks']);
        }

        static function getAll()
        {
            return $_SESSION['list_of_tasks'];
        }

        static function deleteAll()
        {
            $_SESSION['list_of_tasks'] = array();
        }
    }


 ?>
