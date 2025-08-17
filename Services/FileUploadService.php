<?php 
    namespace App\Services;
    
    class FileUploadService {
        private $uploadDir;

        public function __construct($uploadDir)
        {   
            $this->uploadDir = $uploadDir; 
        } 

        public function uploadImoveis($file) {
            if (!empty($file['name'])) {
                $fileName = uniqid().$file['name'];
                $fileDir = $this->uploadDir .'/'.$fileName;
                move_uploaded_file($file['tmp_name'], $fileDir);
                return $fileName;
            }
            return null;
        }

        public function uploadUsers($file) {
            if (!empty($file['name'])) {
                $fileName = $file['name'];
                $fileDir = $this->uploadDir .'/'.$fileName;
                move_uploaded_file($file['tmp_name'], $fileDir);
                return $fileName;
            }
            return null;
        }
    }
?>