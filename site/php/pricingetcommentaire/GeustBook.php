<?php 
require_once 'Message.php';
    class GeustBook{
        private $file;
        public function __construct(string $file)
        {
            // $this->fichier=$fichier;
            $directory = dirname($file);
            if(!is_dir($directory)){
                mkdir($directory, 0777,true);
            }
            if(!file_exists($file)){
                touch($file);
            }
            $this->file = $file;
        }
 
        public function  addMessage(Message $message):void
        {
            file_put_contents($this->file,$message->toJSON() . PHP_EOL, FILE_APPEND);

        }
        public function getMessage():array
        {
            $message=[];
            $contents = trim(file_get_contents($this->file));
            $lines = explode(PHP_EOL,$contents);
            foreach($lines as $line){
               $message[]= Message::fromJSON($line);
            }
            return array_reverse($message);
        }
    }