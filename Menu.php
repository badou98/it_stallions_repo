<?php


include_once "util.php";


class Menu {
    
    protected $text;
    protected $sessionID;
   

    function __construct($text, $sessionId) {
        $this->text = $text;
        $this->sessionID = $sessionId;
       
    }

    public function mainMenuUnregistered() {
        $response = "CON welcome to Daily contribution cooperation \n";
        $response .= "1. Register\n";
        $response .= "2. Help\n";
        echo $response;
    }

    public function MenuRegistered($textArray) {
        // Do something
        $level = count($textArray);
        if ($level == 1) {
            echo "CON set your fullname\n";
        } elseif ($level == 2) {
            echo "CON set your phone number\n";
        } elseif ($level == 3) {
            echo "CON set your PIN\n";
        } elseif ($level == 4) {
            echo "CON confirm your PIN\n";
        } elseif ($level == 5) {
            $name = $textArray[1];
            $phone = $textArray[2];
            $pin = $textArray[3];
            $confirm_pin = $textArray[4];
    
            try {
                include 'conn.php';
                $pdo->beginTransaction();
    
                $statement1 = $pdo->prepare("INSERT INTO registration(full_name, telephone, pin) VALUES(?, ?, ?)");
                $statement1->execute([$name, $phone, $pin]);
                $select = $pdo->query("SELECT user_id FROM registration ORDER BY user_id DESC LIMIT 1");
                $d = $select->fetch(PDO::FETCH_ASSOC);
                $user_id = $d["user_id"];
                $statement2 = $pdo->prepare("INSERT INTO account_tbl(user_id, balance, status) VALUES(?, ?, ?)");
                $balance = 0.0;
                $status = true;
                $statement2->execute([$user_id, $balance, $status]);
    
                $pdo->commit();
    
                if ($pin != $confirm_pin) {
                    echo "END PINs Do not match, retry";
                } else {
                    // Register user
                    // Send SMS
                    echo "END $name You have successfully registered";
                }
            } catch (PDOException $e) {
                $pdo->rollBack();
                echo "END Something went wrong! " . $e->getMessage();
            }
        }
    }
    

    public function mainMenuRegistered() {
        // Do something
        $response = "CON welcome back to Daily contribution cooperation\n";
        $response .= "1. deposit money\n";
        $response .= "2. check balance\n";
        $response .= "3. history\n";
        $response .= "4. setting\n";
        echo $response;
    }
    public function menuDeposit($textArray) {
        // Check the level of user input
        $level = count($textArray);
    
        if ($level == 1) {
            // Prompt user to enter the amount to deposit
            echo "CON Enter amount to deposit:";
        } elseif ($level == 2) {
            // Validate the entered amount (assuming it's a valid numeric value)
            $amount = floatval($textArray[1]); // Convert input to float
            
            if ($amount <= 0) {
                // If amount is not a positive number, prompt user to retry
                echo "END Invalid amount. Please enter a valid amount to deposit.";
            } else {
                // Display confirmation prompt to the user
                echo "CON Deposit $amount RWF?\n";
                echo "1. Confirm\n";
                echo "2. Cancel\n";
            }
        } elseif ($level == 3) {
            // Process the user's confirmation choice
            $confirmation = $textArray[2];
            
            if ($confirmation == "1") {
                // Prompt user to enter PIN for confirmation
                echo "CON Enter your PIN to confirm the deposit:";
            } elseif ($confirmation == "2") {
                echo "END Deposit cancelled.";
            } else {
                echo "END Invalid option. Please try again.";
            }
        } elseif ($level == 4) {
            // Process the user's PIN
            $pin = $textArray[3];
            
            // You can implement PIN validation here
            // For now, let's assume the PIN is valid
            echo "CON PIN confirmed. Processing deposit...\n";
    
            // Continue with the deposit transaction
            $amount = floatval($textArray[1]); // Convert input to float
            $userId = $_SESSION['user_id']; // Assuming user_id is stored in the session
    
            try {
                // Include database connection
                include "conn.php";
    
                // Start a transaction
                $pdo->beginTransaction();
    
                // Retrieve the user's current balance from the database
                $statement = $pdo->prepare("SELECT balance FROM account_tbl WHERE user_id = ?");
                $statement->execute([$userId]);
                $data = $statement->fetch(PDO::FETCH_ASSOC);
                $currentBalance = isset($data['balance']) ? floatval($data['balance']) : 0.0;
    
                // Check if user has sufficient balance for deposit
                if ($currentBalance >= $amount) {
                    // Calculate the new balance after deposit
                    $newBalance = $currentBalance - $amount;
    
                    // Update the user's balance in the account_tbl table
                    $updateStatement = $pdo->prepare("UPDATE account_tbl SET balance = ? WHERE user_id = ?");
                    $updateStatement->execute([$newBalance, $userId]);
    
                    // Record the deposit transaction in the contribution_tbl table
                    $insertStatement = $pdo->prepare("INSERT INTO contribution_tbl (user_id, amount) VALUES (?, ?)");
                    $insertStatement->execute([$userId, $amount]);
    
                    // Insert the transaction into transaction history table
                    $transactionType = 'Deposit';
                    $insertTransaction = $pdo->prepare("INSERT INTO transaction_tbl (user_id, transaction_type, amount, transaction_datetime) VALUES (?, ?, ?, NOW())");
                    $insertTransaction->execute([$userId, $transactionType, $amount]);
    
                    // Commit the transaction
                    $pdo->commit();
    
                    echo "END $amount RWF deposited successfully. New balance: $newBalance RWF.";
                } else {
                    // Insufficient balance for deposit
                    echo "END Insufficient balance for deposit. Please try a smaller amount.";
                }
            } catch (PDOException $e) {
                // Rollback the transaction if any error occurs
                $pdo->rollBack();
                // Handle database errors gracefully
                echo "END Error processing deposit: " . $e->getMessage();
            }
        } else {
            echo "END Invalid input. Please try again.";
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
    


    public function menuCheckBalance($textArray) {
        

        try{
        include "conn.php";

        $statement = $pdo -> prepare("SELECT balance FROM account_tbl where user_id=?");

        $userId = $_SESSION["user_id"];
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

    public function menuTransactionHistory($userId) {
        try {
            // Include database connection
            include "conn.php";
    
            // Prepare and execute the SQL query to fetch transaction history for the given user ID
            $statement = $pdo->prepare("SELECT * FROM transaction_tbl WHERE user_id = ?");
            $statement->execute([$userId]);
    
            // Check if there are any transactions
            if ($statement->rowCount() > 0) {
                // Fetch all rows of the result set
                $transactions = $statement->fetchAll(PDO::FETCH_ASSOC);
    
                // Display the transaction history
                echo "CON Transaction History:\n";
                foreach ($transactions as $transaction) {
                    echo "Transaction ID: " . $transaction['transaction_id'] . "\n";
                    echo "Type: " . $transaction['transaction_type'] . "\n";
                    echo "Amount: " . $transaction['amount'] . "\n";
                    echo "Date: " . $transaction['transaction_date'] . "\n\n";
                }
                echo "END";
            } else {
                // No transactions found for the user
                echo "END No transaction history available.";
            }
        } catch (PDOException $e) {
            // Handle database errors gracefully
            echo "END Error fetching transaction history. Please try again later.";
        }
    }
    
    
    

    
    



}
?>