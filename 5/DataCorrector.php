<?php

class DataCorrector
{
    private int $gender_errors;
    private int $email_errors;
    private array $data;

    public function __construct()
    {
        $this->gender_errors = 0;
        $this->email_errors = 0;
    }

    public function getGenderErrors(): int
    {
        return $this->gender_errors;
    }

    public function getEmailErrors(): int
    {
        return $this->email_errors;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function fix_data()
    {
        $filename = 'OLDBASE.TXT';
        $result_filename = 'result.txt';

        $file_data = file_get_contents($filename);
        $data = preg_split('#\n#', $file_data);

        for ($i = 0; $i < count($data); $i++) {
            $items = preg_split('#,#', $data[$i]);
            $items[0] = $this->parse_id($items[0]);
            $items[4] = $this->parse_gender($items[4]);
            $items[7] = $this->parse_email($items[7]);
            $items[8] = $this->parse_phone($items[8]);
            $items[12] = $this->parse_weight($items[12]);
            $items[] = "\n";
            $data[$i] = implode(";", $items);
        }

        $this->data = $data;
        file_put_contents($result_filename, $data);
    }

    private function parse_id($id)
    {
        $count = 6 - strlen($id);
        $addition = "";
        for ($i = 0; $i < $count; $i++) {
            $addition = $addition . "0";
        }

        return $addition . $id;
    }

    private function parse_gender($gender)
    {
        if ($gender === "male" || $gender === "female") {
            return $gender;
        }
        $this->gender_errors++;
        return "";
    }

    private function parse_email($email)
    {
        if (!preg_match('#^[\w-]+@([\w-]+\.)+[\w-]{2,4}$#', $email)) {

            if (preg_match('#@#', $email, $at)) {
                preg_match('#^[\w-]+#', $email, $name);
                preg_match('#([\w]+\.)#', $email, $mail_name);
                preg_match('#[\w]{2,4}$#', $email, $domain);
                $this->email_errors++;
                return $name[0] . $at[0] . $mail_name[0] . $domain[0];
            }

            $this->email_errors++;
            return "";
        }

        return $email;
    }


    private function parse_phone($phone)
    {
        if (preg_match('#^[0-9]{1}-[0-9]{3}-[0-9]{4}$#', $phone) ||
            preg_match('#^[0-9]{2}-[0-9]{3}-[0-9]{4}$#', $phone) ||
            preg_match('#^[0-9]{3}-[0-9]{3}-[0-9]{4}$#', $phone)) {
            return $phone;
        }

        $phone = str_replace("-", "", $phone);

        if (strlen($phone) === 8) {
            $one = substr($phone, 0, 1);
            $two = substr($phone, 1, 3);
            $three = substr($phone, 4, 4);
            return $one . "-" . $two . "-" . $three;
        }

        if (strlen($phone) === 9) {
            $one = substr($phone, 0, 2);
            $two = substr($phone, 2, 3);
            $three = substr($phone, 5, 4);
            return $one . "-" . $two . "-" . $three;
        }

        if (strlen($phone) === 10) {
            $one = substr($phone, 0, 3);
            $two = substr($phone, 3, 3);
            $three = substr($phone, 6, 4);
            return $one . "-" . $two . "-" . $three;
        }

        return "";
    }

    private function parse_weight($weight)
    {
        $weight = round($weight);
        return "$weight";
    }
}