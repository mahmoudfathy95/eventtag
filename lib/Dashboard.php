<?php

   class Dashboard
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
                 $field=$key_exp[0];

                 $this->$field($data,$key);

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
           $field = explode(':',$value);
           $field_name = $field[0];
          if(empty($data[$field_name]))
          {
            if(isset($field[1]))
            {
              $filed_value = $field[1];
            }else
            {
              $filed_value = $field[0];
            }

            $this->errors[$field_name] = $filed_value.' is required';

          }
        }

         public function string($data,$value)
        {

           if(!is_string($data[$value]))
           {
            echo json_encode(['message'=>$value.' must be string']);
            http_response_code(400);
            exit();
           }

        }

         public function size($data,$value)
        {

          if(!empty($this->size))
          {
            if( strlen($data[$value]) < $this->size)
           {

            echo json_encode(['message'=>$value.' must be more than '.$this->size]);
            http_response_code(400);
            exit();
           }
          }


        }



        public function integer($data,$value)
        {
          if(empty($data[$value]))
          {
             echo json_encode(['message'=>$value.' must be  integer']);
            http_response_code(400);
            exit();
          }
        }

        public function email($data,$value)
        {
          if(!filter_var($data[$value],FILTER_VALIDATE_EMAIL))
          {
            echo json_encode(["message"=>"please enter valid email"]);
            http_response_code(400);
            exit();
          }
        }

        public function confirm($data,$value)
        {

          if(!empty($this->size))
          {
            if($data[$value] != $data[$this->size])
            {
              echo json_encode(['message'=>'must be confirm equal '.$this->size]);
              http_response_code(400);
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
              echo json_encode(['message'=>'this '. $value.' already exists']);
              http_response_code(400);
              exit();
            }
          }

        }
        
        
        public function notification($firebase,$body,$title)
        {
           $authToken = 'key=AAAABYlv-tA:APA91bGms0ZJI-AtXlW6lBA1MVD1TFq9GKpuQabmzRv1a7LY9KqH3-5tYoNhAC4Lkys97OX_PpJt9xKKpFWChJjM2gwSqQe0oKSCnvs9VUNvPWydCgJB3wQ7MOVSFP1TOY2KMNlopZqH';
           
            // The data to send to the API
            $postData = array(
                'priority' => 'HIGH',
                'to' => $firebase,
                'notification' =>array('body' =>$body ,'title'=>$title ),
                'data' =>array('body' =>$body ,'title'=>$title )
            );

            // Setup cURL
            $ch = curl_init('https://fcm.googleapis.com/fcm/send');
            curl_setopt_array($ch, array(
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: '.$authToken,
                    'Content-Type: application/json'
                ),
                CURLOPT_POSTFIELDS => json_encode($postData)
            ));

            // Send the request
            $response = curl_exec($ch);
            
            // Check for errors
            if($response === FALSE){
                die(curl_error($ch));
            }else
            {
                return $response;
            }
        }








   }

?>
