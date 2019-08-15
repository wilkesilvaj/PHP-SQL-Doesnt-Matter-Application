<?php

class coachmapper    {

    //Attributes
    public $lastInsertId = null;

    // Function which adds a new coach into the database
    function create($postdata)  
    {

        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p -> connect();

        //Setup the Bind Parameters
        $bindParams = [
        'coachFName' => $postdata['firstName'],
        'coachLName' => $postdata['lastName'],
        'salary' => $postdata['salary'],
        'teamName' => $postdata['team'],
        'dateStarted' => $postdata['dateStarted'],
        'endOfContract' => $postdata['endOfContract']];
       
        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO Coaches (coachFName, coachLName, salary, teamName, dateStarted, endOfContract)
        VALUES (:coachFName, :coachLName, :salary, :teamName, :dateStarted, :endOfContract )", $bindParams);
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
            header('Location: DoesntMatter.php?entity=coaches&message=Coach created succesfully');
        }
          
    }

    // Function to update the selected coach's information
    function update($postdata) 
    {
        
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [
            'coachId' => $postdata['coachId'],
            'coachFName' => $postdata['firstName'],
            'coachLName' => $postdata['lastName'],
            'salary' => $postdata['salary'],
            'teamName' => $postdata['team'],
            'dateStarted' => $postdata['dateStarted'],
            'endOfContract' => $postdata['endOfContract']];
               
     
        //Get the results of the insert query (rows inserted)
        $results = $p->query("UPDATE Coaches SET coachFName = :coachFName, coachLName = :coachLName, salary = :salary, teamName = :teamName, dateStarted = :dateStarted, endOfContract = :endOfContract WHERE coachId = :coachId;", $bindParams);
       
       //Disconnect from the database
        $p->disconnect();
        
        // IF the query "did not work"
        if ($p->rowcount != 1)  {
            trigger_error("An error has occured");
            die();
        }
        else
        { 
            header('Location: DoesntMatter.php?entity=coaches&message=Coach updated succesfully');
        }        
    }

    // Function which deletes the selected coach
    function delete($coachId)
    {   
           
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
       $bindParams = ["id" => $coachId];
        
        //Get the results of the insert query (rows inserted)
        $results = $p->query("DELETE FROM Coaches WHERE coachId = :id;", $bindParams);
        var_dump($results);
        //Disconnect from the database
        $p->disconnect();
        
        // IF the query "did not work"
        if ($p->rowcount != 1)  {
            trigger_error("An error has occured");
            die();
        }
        else
        { 
            header('Location: DoesntMatter.php?entity=coaches&message=Coach deleted succesfully');
        }
   
    }

    // Function which lists all coaches on the database
    function listAll() 
    {
        
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM Coaches;", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;

    }

    // Function which lists all the coaches based on the search term(s)
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
        $results = $p->query("SELECT * FROM Coaches WHERE coachFName LIKE :term OR
        coachLName LIKE :term OR salary LIKE :term OR teamName LIKE :term 
        OR dateStarted LIKE :term OR endOfContract LIKE :term;", $bindParams);
              
        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }


    // This function is used on the update form, it gets the selected coach's information and displays it as default on the update form 
    function listOne($coachId)
    {
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = ['coachId' => $coachId];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM Coaches WHERE coachId = :coachId;", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }

    // Function which generates the statistics for the coaches
    function getStatistics()
    {
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT COUNT(coachId) as qtyOfCoaches, teamName FROM Coaches GROUP BY teamName;", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }
  
}

?>