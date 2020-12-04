<?php
  
  class image
  {
    private $name;
    private $basename;
    private $tmp;
    public $direction = 'https://eventatglobal.com/uploads/';
    private $extension;
    public  $path;
    public $extenImages=[];



    public function __construct($name)
    {
      $this->name = $name;
    
    }


    public function storage()
    {
      if (is_array($_FILES[$this->name]["name"]) && count($_FILES[$this->name]["name"]) > 1) 
      {
             $images ="";
        for($i=0;$i<count($_FILES[$this->name]["name"]);$i++)
        {
          $path=str_replace(' ','', $this->path).$i;
           
          $this->basename = basename($_FILES[$this->name]["name"][$i]);
          $this->tmp =$_FILES[$this->name]["tmp_name"][$i]; 
          $this->extension = strtolower(pathinfo($this->basename,PATHINFO_EXTENSION));
          $this->check($this->extenImages);
          $store_image =  $this->direction.$path.'.'.$this->extension;
          move_uploaded_file($this->tmp, $store_image);

          $images .= $store_image;
          if($i != count($_FILES[$this->name]["name"])-1)
          {
            $images .= ',';
          }
        }

        return $images;
           
      }else
      {
           $this->basename = basename($_FILES[$this->name]["name"]);
        $this->tmp =$_FILES[$this->name]["tmp_name"]; 
        $this->extension = strtolower(pathinfo($this->basename,PATHINFO_EXTENSION));
        $this->check($this->extenImages);
        $path = str_replace(' ','', $this->path);
        $store_image =  $this->direction.$path.'.'.$this->extension;
        move_uploaded_file($this->tmp, $store_image);
        return 'uploads/'.$path.'.'.$this->extension;  
      
       
      }
    }
    
      public function check($extenImages)
    {
      if(!in_array($this->extension,$extenImages))
      {
        $errors=[];
        http_response_code(400);
        $errors[$this->name] = 'يجب ان تكون صورة (jpeg-jpg-png)';
        echo json_encode(['errors'=>$errors]);
        exit();
      }

    }


   

  }

?>