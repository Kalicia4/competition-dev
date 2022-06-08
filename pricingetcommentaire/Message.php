<?php
    class Message{
        private $message;
        private $username;
        private $date;
        const LIMIT_USERNAME = 3;
        const LIMIT_MESSAGE = 10;
        public function __construct(string $message, string $username, ?DateTime $date=null){
                $this->message=$message;
                $this->username=$username;
                $this->date=$date ?? new DateTime();
        }
        public function isvalid():bool{
            return empty($this->geterrors());
        }
        public function geterrors():array{
            $errors = [];
            if(strlen($this->username) < self::LIMIT_USERNAME){
                $errors['username'] = "Votre nom d' utilisateur est incorrecte";
            }
            if(strlen($this->message) < self::LIMIT_MESSAGE){
                $errors['message'] = "Votre messages est incorrecte";
            }
            return $errors;
        }
        public function toHTML():string
        {
            $username= htmlentities($this->username);
            $message= nl2br(htmlentities($this->message));
            $this->date->setTimezone(new DateTimeZone('Europe/Paris'));
            $date= $this->date->format("Y-m-d at H:i:s");
            return <<<HTML
            <p>
                <strong>$username</strong><em>le $date</em><br>
                $message;
            </p>
HTML;
        }
        public function toJSON():string{
            return json_encode([
                'username' => $this->username,
                'message' => $this->message,
                'date' => $this->date->getTimestamp()
            ]);

         }
        public static function fromJSON($json):Message{
            $data = json_decode($json,true);
            return new self($data['message'], $data['username'], new DateTime("@" . $data['date']));

        }
    }