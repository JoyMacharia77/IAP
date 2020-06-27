<?php
    include_once "DBConnector.php";

    class FileUploader{

        //Member Variables
        private static $target_directory = "uploads/";
        private static $size_limit = 50000; //Size in bytes
        private $uploadOk = false;
        private $file_original_name;
        private $final_type;
        private $file_size;
        private $final_file_name;
       // private $temporary_file_name;

        public function __construct($data)
        {
            $this->file_original_name = $data['name'];
            $this->file_size = $data['size'];
            $this->final_type = $data['type'];
            $this->file_tmp_name = $data['tmp_name'];
        }

        //Getters and setters
        public function setOriginalName($name)
        {
            $this->file_original_name = $name;
        }

        public function getOriginalName()
        {
            return $this->file_original_name;
        }
     /*   public function setTemporaryFileName($tmp_name){
            $this->file_tmp_name = $tmp_name;
        }

        public function getTemporaryFilename(){
            return $this->file_tmp_name;
        }
        */

        public function setFileType($type)
        {
            $this->final_type = $type;
        }

        public function getFileType()
        {
            return $this->final_type;
        }

        public function setFileSize($size)
        
        {
            $this->file_size = $size;
        }

        public function getFileSize()
        {
            return $this->file_size;
        }

        public function setFinalFileName($final_name)
        {
            $this->final_file_name = $final_name;
        }

        public function getFinalFileName()
        {
            return $this->final_file_name;
        }


        //Methods

        public function uploadFile()
        {
            $connect = new DBConnector();
            $this->moveFile();
      
            $image = $this->getOriginalName();
      
            //If File has been moved send post to database
            if($this->uploadOk){
      
              $result_set = mysqli_query($connect->conn, 
              "UPDATE user_table SET image='$image' WHERE username='$username'") or die("Error".mysqli_error($this->conn));
      
            }
      
        }
        
        public function fileAlreadyExists()
        {
            //Check if the file exists
            if(!file_exists("uploads/" . $this->file_original_name)){
                return true;
            }else{
                return false;
            }
        }
        public function saveFilePathTo()
        {
            return FileUploader::$target_directory;
        }
            
        public function moveFile()
        {
            if(move_uploaded_file($this->file_tmp_name, $this->saveFilePathTo() . $this->file_original_name)){
                return true;
            }else{
                return false;
            }

        }
        public function fileTypeIsCorrect()
        {
             //The allowed_type File Types
             $allowed_type = array(
                "gif" => "image/gif",
                "png" => "image/png",
                "jpg" => "image/jpg",
                 "jpeg" => "image/jpeg"
                 );
            // File Extension Verification
            $ext = pathinfo($this->file_original_name, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed_type)){
                return false;
            }else{
                if(!in_array($this->final_type, $allowed_type)){
                    return false;
                }else{
                    return true;
                }
            }     
        }
        public function fileSizeIsCorrect()
        {
            if($this->file_size > FileUploader::$size_limit){
                return false;
            }else{
                return true;
            } 
        }
        public function fileWasSelected()
        {
            if($this->file_original_name){
                return false;
              }else
              {
                  return  true;
              }

        }

       
    }
?>