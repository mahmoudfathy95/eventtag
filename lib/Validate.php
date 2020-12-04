<?php

   class Validate
   {

        private $errors=[];
        private $size;
     
        public function validation($data,$para=[])
        {
          
          foreach ($para as $key => $value) 
            {
              
              $value_rep = str_replace(' ', '', $value);
              $value_exp = explode('|', $value_rep);
              foreach ($value_exp as $key_exp ) 
              {
                $key_exp = explode(':', $key_exp);
                if(isset($key_exp[1]))
                {
                  $this->size = $key_exp[1];
                }
               
                if(method_exists($this, $key_exp[0]))
                {
                 $funcname = $key_exp[0];
                 $this->$funcname($data,$key);
                   
                }else
                {
                  return 'no found any method for ('.$key_exp.')';
                }
              }
              
            }

            return $this->errors;

        }

     
        public function required($data,$value)
        {
           

          if(empty($data[$value]) && empty($this->errors[$value]))
          {
              http_response_code(400);
            echo json_encode(['message'=>$value.' is required']);
            
            exit();
          } 
        }

         public function string($data,$value)
        {
           
           if(!is_string($data[$value]))
           {
               http_response_code(400);
            echo json_encode(['message'=>$value.' must be string']);
            exit();
           }
          
        }

         public function size($data,$value)
        {

          if(!empty($this->size))
          {
            if( strlen($data[$value]) < $this->size)
           {
           http_response_code(400);
            echo json_encode(['message'=>$value.' must be more than '.$this->size]);
           
            exit();
           }
          }
           
          
        }



        public function integer($data,$value)
        {
          if(empty($data[$value]))
          {
              http_response_code(400);
             echo json_encode(['message'=>$value.' must be  integer']);
           
            exit();
          } 
        }

        public function email($data,$value)
        {
          if(!filter_var($data[$value],FILTER_VALIDATE_EMAIL))
          {
              http_response_code(400);
            echo json_encode(["message"=>"please enter valid email"]);
            
            exit();
          }
        }

        public function confirm($data,$value)
        {

          if(!empty($this->size))
          {
            if($data[$value] != $data[$this->size])
            {
                http_response_code(400);
              echo json_encode(['message'=>'must be confirm equal '.$this->size]);
             
              exit();
            }
          }
        }

         public function unique($data,$value)
        {
          if(!empty($this->size))
          {
            $table = $this->size;
            $check = $table::where($value,$data[$value])->first();
            if(!empty($check))
            {
                http_response_code(400);
              echo json_encode(['message'=>'this '. $value.' already exists']);
              
              exit();
            }
          }
          
        }


     





   }

?>