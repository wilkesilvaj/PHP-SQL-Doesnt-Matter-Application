<?php

class playermapper    
{
    //Attributes
    public $lastInsertId = null;

    // Function which adds a new player into the database
    function create($postdata)  
    {

        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p -> connect();

        //Setup the Bind Parameters
        $bindParams = [
        'firstName' => $postdata['firstName'],
        'lastName' => $postdata['lastName'],
        'age' => $postdata['age'],
        'teamName' => $postdata['team'],
        'position' => $postdata['position'],
        'nationality' => $postdata['nationality']];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO Players (firstName, lastName, age, teamName, position, nationality)
        VALUES (:firstName, :lastName, :age, :teamName, :position, :nationality)", $bindParams);
        //copy the last inserted id
        $this->lastInsertId = $p->lastInsertId;

        //Disconnect from the database
        $p->disconnect();
        
        // IF the query "did not work"
        if ($p->rowcount != 1)  {
            trigger_error("An error has occured");
            die();
        }
        else
        { 
            header('Location: DoesntMatter.php?entity=players&message=Player created succesfully');
        }
    }

    // Function to update the selected player's information
    function update($postdata) 
    {
        
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [
        'playerId' => $postdata['playerId'],
        'firstName' => $postdata['firstName'],
        'lastName' => $postdata['lastName'],
        'age' => $postdata['age'],
        'teamName' => $postdata['team'],
        'position' => $postdata['position'],
        'nationality' => $postdata['nationality']];
        

        //Get the results of the insert query (rows inserted)
        $results = $p->query("UPDATE Players SET firstName = :firstName, lastName = :lastName, age = :age, teamName = :teamName, position = :position, nationality = :nationality WHERE playerId = :playerId;", $bindParams);
       
       //Disconnect from the database
        $p->disconnect();
        
        // IF the query "did not work"
        if ($p->rowcount != 1)  {
            trigger_error("An error has occured");
            die();
        }
        else
        { 
            header('Location: DoesntMatter.php?entity=players&message=Player updated succesfully');
        }
               
    }

    // Function which deletes the selected player
    function delete($playerId)   
    {        
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
       $bindParams = ["id" => $playerId];
        
        //Get the results of the insert query (rows inserted)
        $results = $p->query("DELETE FROM Players WHERE playerId = :id;", $bindParams);
        
        //Disconnect from the database
        $p->disconnect();

        // IF the query "did not work"
        if ($p->rowcount != 1)  {
            trigger_error("An error has occured");
            die();
        }
        else
        { 
            header('Location: DoesntMatter.php?entity=players&message=Player deleted succesfully');
        }
    }

    // Function which lists all players IF NO SEARCH TERMS WERE INPUT
    function listAll() {
        
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM Players;", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }

    // Function which lists all players IF A SEARCH TERM WAS INPUT
    function listAllWithSearch($term) 
    {
        $newTerm = "%".$term."%";

        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = ["term"=>$newTerm];
        
        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM Players WHERE firstName LIKE :term OR
        lastName LIKE :term OR age LIKE :term OR teamName LIKE :term OR
        position LIKE :term OR nationality LIKE :term;", $bindParams);
              
        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }

    // This function is used on the update form, it gets the selected players's information and displays it as default on the update form 
    function listOne($playerId)
    {
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = ['playerId' => $playerId];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM Players WHERE playerId = :playerId;", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }

    // Function which generates the statistics for the players
    function getStatistics()
    {
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT COUNT(PlayerId) as qtyOfPlayers, teamName FROM Players GROUP BY teamName ORDER BY teamName", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }
    
}

?>