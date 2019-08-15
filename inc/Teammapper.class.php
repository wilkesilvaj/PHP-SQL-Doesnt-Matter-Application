<?php

class teammapper    
{

    //Attributes
    public $lastInsertId = null;

    // Function which adds a new team into the database
    function create($postdata)  {

        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p -> connect();

        //Setup the Bind Parameters
        $bindParams = [
        'teamName' => $postdata['teamName'],
        'province' => $postdata['province'],
        'city' => $postdata['city'],
        'stadium' => $postdata['stadium']];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("INSERT INTO Teams (teamName, province, city, stadium)
        VALUES (:teamName, :province, :city, :stadium )", $bindParams);
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
            header('Location: DoesntMatter.php?entity=teams&message=Team created succesfully');
        }
         
    }

    // Function to update the selected team's information
    function update($postdata) 
    {        
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
       $bindParams = ["teamId" => $postdata['teamId'],
       "teamName" => $postdata['teamName'],
       "stadium" => $postdata['stadium'],
       "province" => $postdata['province'],
       "city" => $postdata['city']];

        //Get the results of the insert query (rows inserted)
       $results = $p->query("UPDATE Teams SET teamName = :teamName, province = :province, city = :city, province = :province WHERE teamId = :teamId;", $bindParams);
       
       //Disconnect from the database
        $p->disconnect();
        
        // IF the query "did not work"
        if ($p->rowcount != 1)  {
            trigger_error("An error has occured");
            die();
        }
        else
        { 
            header('Location: DoesntMatter.php?entity=teams&message=Team updated succesfully');
        }

    }

    // Function which deletes the selected team
    function delete($teamId)   
    {
        
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
       $bindParams = ["id" => $teamId];
            
        //Get the results of the insert query (rows inserted)
        $results = $p->query("DELETE FROM Teams WHERE teamId = :id;", $bindParams);
       
        //Disconnect from the database
        $p->disconnect();
        
        // IF the query "did not work"
        if ($p->rowcount != 1)  {
            trigger_error("An error has occured");
            die();
        }
        else
        { 
            header('Location: DoesntMatter.php?entity=teams&message=Team deleted succesfully');
        }
        
    }

    // Function which lists all team on the database
    function listAll() 
    {
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = [];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM Teams;", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }

    // Function which lists all the team based on the search term(s) 
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
        $results = $p->query("SELECT * FROM Teams WHERE teamName LIKE :term OR
        province LIKE :term OR city LIKE :term OR stadium LIKE :term;", $bindParams);
              
        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }
    
    // This function is used on the update form, it gets the selected team's information and displays it as default on the update form 
    function listOne($teamId)
    {
        //new PDOAgent
        $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

        //Connect to the Database
        $p->connect();

        //Setup the Bind Parameters
        $bindParams = ['teamId' => $teamId];

        //Get the results of the insert query (rows inserted)
        $results = $p->query("SELECT * FROM Teams WHERE teamId = :teamId;", $bindParams);

        //Disconnect from the database
        $p->disconnect();
        
        //Return the objects
        return $results;
    }

    // Function which generates the statistics for the teams
    function getStatistics()
    {
         //new PDOAgent
         $p = new PDOAgent("mysql", DB_USER, DB_PASS, DB_HOST, DB_NAME);

         //Connect to the Database
         $p->connect();
 
         //Setup the Bind Parameters
         $bindParams = [];
 
         //Get the results of the insert query (rows inserted)
         $results = $p->query("SELECT COUNT(teamId) as qtyOfTeams, province FROM Teams GROUP BY province;", $bindParams);
 
         //Disconnect from the database
         $p->disconnect();
         
         //Return the objects
         return $results;
    }

}

?>