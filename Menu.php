<?php

session_start();

include_once "util.php";

class Menu {
    
    protected $text;
    protected $sessionID;
   

    function __construct($text, $sessionId) {
        $this->text = $text;
        $this->sessionID = $sessionId;
       
    }

    public function mainMenuUnregistered() {
        $response = "CON welcome to XYZ MOMO \n";
        $response .= "1. Register\n";
        echo $response;
    }

    public function MenuRegistered($textArray) {
        // Do something
        $level = count($textArray);
        if ($level == 1) {
            echo "CON set your fullname\n";
        } elseif ($level == 2) {
            echo "CON set your phone number\n";
        }elseif ($level == 3) {
            echo "CON set your PIN\n";
        } elseif ($level == 4) {
            echo "CON confirm your PIN\n";
        } elseif ($level == 5) {
            $name = $textArray[1];
            $phone = $textArray[2];
            $pin = $textArray[3];
            $naconfirm_pin = $textArray[4];


            try{

            include "con.php";


            $pdo->beginTransaction();

            $statement1 = $pdo->prepare("INSERT INTO registration(full_name,telephone,pin) VALUES(?,?,?)");
            $statement1->execute([$name,$phone,$pin]);
            $select = $pdo->query("SELECT user_id FROM registration ORDER BY user_id DESC LIMIT 1");
            $d = $select->fetch(PDO::FETCH_ASSOC);
            $user_id = $d["user_id"];
            $statement2 = $pdo->prepare("INSERT INTO account_tbl(user_id,balance,status) VALUES(?,?,?)");
            $balance = 0.0;
            $status = true;
            
            
            $statement2->execute([$user_id,$balance,$status]);

            $pdo->commit();

            }catch(PDOException $e)
            {
                $pdo->rollBack();
                echo "something went wrong!". $e->getMessage();
            }
        
            if ($pin != $naconfirm_pin) {
                echo "END PINs Do not match, retry";
            } else {
                
                
                // Register user
                // Send SMS
                echo "END $textArray[1] You have successfully registered";
            }
        }
    }


    public function mainMenuRegistered() {
        // Do something
        $response = "CON welcome back to XYZ MOMO,\n";
        $response .= "1. send money\n";
        $response .= "2. withdraw money\n";
        $response .= "3. check balance\n";
        echo $response;
    }

    public function menuSendmoney($textArray) {
        // Do something 
        $level = count($textArray);
        if ($level == 1) {
            echo "CON enter recipient phone number";
        } elseif ($level == 2) {
            echo "CON enter amount";
        } elseif ($level == 3) {
            echo "CON enter PIN \n";

        } elseif ($level==4){

            


            $response = "CON send ".$textArray[2] . " to -".$textArray[1]."\n";
            $response .= "1. confirm\n";
            $response .= "2. cancel\n";
            $response .= Util::$goBack .". Back\n";
            $response .= Util::$go_main_menu .". Main Menu\n";

            echo $response;
        }
        
        else {

            
            
            echo "END $textArray[2] rwf sent to $textArray[1] successful\n";
        }
    }

    public function middleware($text){
        // Call goBack method and then goToMainMenu method
        return $this->goBack($this->goToMainMenu($text));
    }

    public function goBack($text){

        $explodeText = explode("*",$text);

        while(array_search(Util::$goBack,$explodeText) != false){
            $firstIndex = array_search(Util::$goBack,$explodeText);
            array_splice($explodeText,$firstIndex-1,2);
        }

        return join("*",$explodeText);


    }

    public function goToMainMenu($text){
        $explodeText = explode("*",$text);

        while(array_search(Util::$go_main_menu,$explodeText) != false){
            $firstIndex = array_search(Util::$go_main_menu,$explodeText);
            $explodeText = array_slice($explodeText,$firstIndex+1);
        }

        return join("*",$explodeText);

    }
    

    public function menuWithdrawMoney($textArray) {
        // Do something
        $level = count($textArray);
        if ($level == 1) {
            echo "CON enter amount\n";
        } elseif ($level == 2) {
            echo "CON enter agent code\n";
        } elseif ($level == 3) {
            echo "CON enter your PIN\n";
        } elseif ($level == 4) {
            echo "END you have successfully withdrawn. Collect your money\n";
        }
    }

    public function menuCheckBalance($textArray) {
        

        try{
        include "con.php";

        $statement = $pdo -> prepare("SELECT balance FROM account_tbl where user_id=?");

        $userId = $_SESSION["id"];
        $statement -> execute([$userId]);

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $balance = $data["balance"];
 

        }catch(PDOException $e){
            echo $e->getMessage();
        }



        $level = count($textArray);
        if ($level == 1) {
            echo "CON enter Your PIN\n";
        } else {
            echo "END balance ".$balance."\n";
        }
    }


}
?>