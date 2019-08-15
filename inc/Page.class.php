<?php 

class Page {

    static public $title = "Please set the title";

    // Renders the page header
    static function header() 
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
            <!--Import Google Icon Font-->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!--Import materialize.css-->
            <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
            <link type="text/css" rel="stylesheet" href="css/grid.css"/>
            
            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            </head>

            <body>
            <div class= "container"><H1><?php echo self::$title; ?></H1></div>
            <div class="main">
                <div class="box header">
            <H5>
                <A HREF="?entity=players"> Players </a>
                <A HREF="?entity=teams"> Teams </a>
                <A HREF="?entity=coaches"> Coaches </a>
            </H5>
                
            <?php
            if (isset($_GET['message']))
            {
                echo '<H4>'.$_GET['message'].'</H4>';
            }
            ?>
        </div>
       
        <?php
    } 
    // Renders the players table 
    static function createTablePlayers($players)
    { 
        // Checks if NO PLAYERS were gathered from the database, and if so, prints a displays a message instead of the table
        if ($players == null)
        {
            if (!empty($_GET['search']))
            {
                ?>
                <div class="box content">
                    <H5>No results found for "<?php echo $_GET['search']; ?>"</H5>
                </div>
            <?php
            }
            else
            {
                ?>
                <div class="box content">
                    <H5>No players in the database</H5>
                    <a href = "?action=createPlayer">Add a new player</a>
                </div>
                <?php
            }
        }
        // If ANY PLAYERS were gathered from the database, prints the table with their information
        else
        {

            ?>
                <div class="box content">
                    <TABLE>
                        <THEAD>
                            <TR>
                                <TH>First Name</TH>
                                <TH>Last Name</TH>
                                <TH>Age</TH>
                                <TH>Team</TH>
                                <TH>Position</TH>
                                <TH>Nationality</TH>
                                <TH>Update</TH>
                                <TH>Delete</TH>
                            </TR>
                        </THEAD>
                        <TFOOT>
                            <TR>
                                <TH> <a href = "?action=createPlayer">Add a new player</a></TH>
                            </TR>
                        </TFOOT>
                        <TBODY>
                            <?php
                            // Prints each player's information
                            foreach ($players as $player)   
                            {
                                echo '<TR>
                                <TD>'.$player->firstName.'</TD>
                                <TD>'.$player->lastName.'</TD>
                                <TD>'.$player->age.'</TD>
                                <TD>'.$player->teamName.'</TD>
                                <TD>'.$player->position.'</TD>
                                <TD>'.$player->nationality.'</TD>
                                <TD><a href = "?action=updatePlayer&playerID='.$player->playerId.'">Update</a></TD>
                                <TD><a href = "?action=deletePlayer&playerID='.$player->playerId.'">Delete</a></TD>
                                </TR>';
                            } 
                            ?>
                        </TBODY>
                    </TABLE>
                    
                </div>
            <?php 
        }

    }

    // Renders the teams table
    static function createTableTeams($teams) 
    { 
        // Checks if NO TEAMS were gathered from the database, and if so, prints a displays a message instead of the table
        if ($teams == null)
        {
            if (!empty($_GET['search']))
            {
                ?>
                <div class="box content">
                    <H5>No results found for "<?php echo $_GET['search']; ?>"</H5>
                </div>
            <?php
            }
            else
            {
                ?>
                <div class="box content">
                    <H5>No team in the database</H5>
                    <a href = "?action=createTeam">Add a new team</a>
                </div>
                <?php
            }
        }       

        // If ANY TEAMS were gathered from the database, prints the table with their information
        else
        {
            ?>

            <div class="box content">
                <TABLE>
                    <THEAD>
                        <TR>
                            <TH>Name</TH>
                            <TH>Province</TH>
                            <TH>City</TH>
                            <TH>Stadium</TH>
                            <TH>Update</TH>
                            <TH>Delete</TH>
                        </TR>
                    </THEAD>
                    <TFOOT>
                        <TR>
                            <TH> <a href = "?action=createTeam">Add a new team</a></TH>
                        </TR>
                    </TFOOT>
                    <TBODY>
                    <?php 
                    // Prints each team's information 
                    foreach ($teams as $team)    {
                            echo '<TR>
                            <TD>'.$team->teamName.'</TD>
                            <TD>'.$team->province.'</TD>
                            <TD>'.$team->city.'</TD>
                            <TD>'.$team->stadium.'</TD>
                            <TD><a href = "?action=updateTeam&teamID='.$team->teamId.'">Update</a></TD>
                            <TD><a href = "?action=deleteTeam&teamID='.$team->teamId.'">Delete</a></TD>
                            </TR>';
                        } ?>
                    </TBODY>
                </TABLE>
            </div>
            <?php
        }
    }

    // Renders the coaches table
    static function createTableCoaches($coaches)
    {
        // Checks if NO COACHES were gathered from the database, and if so, prints a displays a message instead of the table
        if ($coaches == null)
        {
            if (!empty($_GET['search']))
            {
                ?>
                <div class="box content">
                    <H5>No results found for "<?php echo $_GET['search']; ?>"</H5>
                </div>
            <?php
            }
            else
            {
                ?>
                <div class="box content">
                    <H5>No coaches in the database</H5>
                    <a href = "?action=createCoach">Add a new coach</a>
                </div>
                <?php
            }
            
        }
        // If any COACHES were gathered from the database, prints the table with their information
        else
        {
            ?>
            <div class="box content">
                <TABLE>
                    <THEAD>
                        <TR>
                            <TH>First Name</TH>
                            <TH>Last Name</TH>
                            <TH>Salary</TH>
                            <TH>Team Name</TH>
                            <TH>Date Started</TH>
                            <TH>End of Contract</TH>
                            <TH>Update</TH>
                            <TH>Delete</TH>
                        </TR>
                    </THEAD>
                    <TFOOT>
                        <TR>
                            <TH> <a href = "?action=createCoach">Add a new coach</a></TH>
                        </TR>
                    </TFOOT>
                    <TBODY>
                    <?php 
                    // Prints each coach's information
                    foreach ($coaches as $coach)   
                    {
                        echo '<TR>
                        <TD>'.$coach->coachFName.'</TD>
                        <TD>'.$coach->coachLName.'</TD>
                        <TD>'.$coach->salary.'</TD>
                        <TD>'.$coach->teamName.'</TD>
                        <TD>'.$coach->dateStarted.'</TD>
                        <TD>'.$coach->endOfContract.'</TD>
                        <TD><a href = "?action=updateCoach&coachID='.$coach->coachId.'">Update</TD>
                        <TD><A HREF="?action=deleteCoach&coachID='.$coach->coachId.'">Delete</A></TD>
                        </TR>';
                    } 
                    ?>
                    </TBODY>
                    </TBODY>
                </TABLE>
            </div>
            <?php
        }
        
    }

    // Renders the form to update a player's information
    static function updatePlayerForm($player, $teams)
    { 
         // Verifies if there is any POST data
         if (!empty($_POST))
         {
            
             // Verifies if the ENTIRE FORM was filled in, and if so, creates the new player
             if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['age']) && !empty($_POST['team']) && !empty($_POST['position']) && !empty($_POST['nationality']))
             {
               
                $pm = new playermapper();
                $pm->update($_POST);
             }
        }

        // Creates an array from which to get the player's data
         foreach ($player as $attribute)
        {
             $myPlayer = ['playerId'=>$attribute->playerId,
             'fName'=>$attribute->firstName,
            'lName'=>$attribute->lastName,
            'age'=>$attribute->age,
            'teamName'=>$attribute->teamName,
            'position'=>$attribute->position,
            'nationality'=>$attribute->nationality        
            ];
        }
               
        ?>    
        <div class="box content">    
            <FORM METHOD="POST" ACTION="">
                <DIV CLASS="form-group">
                    <INPUT TYPE="hidden" NAME="playerId" ID="playerId" VALUE="<?php echo $myPlayer['playerId']; ?>" />
                    <LABEL FOR="firstName">First Name</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="firstName" ID="firstName" ARIA-DESCTIBEDBY="firstNameHelp" VALUE = "<?php echo $myPlayer['fName']; ?>">
                </DIV>
        
                <DIV CLASS="form-group">
                    <LABEL FOR="lastName">Last Name</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="lastName" ID="lastName" ARIA-DESCTIBEDBY="lastNameHelp" VALUE = "<?php echo $myPlayer['lName']; ?>">
                </DIV>

                <DIV CLASS="form-group">
                    <LABEL FOR="age">Age</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="age" maxlength="2" ID="age" ARIA-DESCTIBEDBY="ageHelp" VALUE = "<?php echo $myPlayer['age']; ?>">
                </DIV>
                <!-- THIS IS NOT SHOWING FOR SOME REASON BECAUSE OF MATERIALIZE -->
                <DIV CLASS="form-group">
                    <LABEL FOR="team">Team</LABEL>
                    <SELECT NAME = "team" ID="team" class="browser-default">
                    <?php
                    // Loop which populates the select based on the teams that are in the database
                        foreach ($teams as $team)   
                        {
                            echo '<OPTION VALUE = "'.$team->teamName.'">'.$team->teamName.'</OPTION>';
                        } 
                    // Closes the select and continues to print the form
                    ?>
                    </SELECT>
                </DIV>

                <DIV CLASS="form-group">
                    <LABEL FOR="position">Position</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="position" ID="position" ARIA-DESCTIBEDBY="lastNameHelp" VALUE = "<?php echo $myPlayer['position']; ?>">
                </DIV>

                <DIV CLASS="form-group">
                    <LABEL FOR="nationality">Nationality</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="nationality" ID="nationality" ARIA-DESCTIBEDBY="lastNameHelp" VALUE = "<?php echo $myPlayer['nationality']; ?>">
                </DIV>

                <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" VALUE="Update Player Information">
                
            </FORM>
        </DIV>

        <?php 
    }

    // Renders the form to update a team's information
    static function updateTeamForm($team)
    {
        // Verifies if there is any POST data
        if (!empty($_POST))
        {
            // Verifies if the ENTIRE FORM was filled in, and if so, creates the new team
            if (!empty($_POST['teamId']) && !empty($_POST['teamName']) && !empty($_POST['stadium']) && !empty($_POST['province']) && !empty($_POST['city']))
            {
               $tm = new teammapper();
               $tm->update($_POST);            
            }
        }

        // Creates an array from which to get the team's data
        foreach ($team as $attribute)
        {
            $myTeam = ['teamId' =>$attribute->teamId,
            'teamName'=>$attribute->teamName,
            'province'=>$attribute->province,
            'city'=>$attribute->city,
            'stadium'=>$attribute->stadium];
        }
        ?>
        <div class="box content">
        <FORM METHOD="POST" ACTION="">
            <DIV CLASS="form-group">
                <INPUT TYPE="hidden" NAME="teamId" ID="teamId" value ="<?php echo $myTeam['teamId']; ?>"
                <LABEL FOR="teamName">Team Name</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="teamName" ID="teamName" ARIA-DESCTIBEDBY="firstNameHelp" value="<?php echo $myTeam['teamName']; ?>">
            </DIV>
      
            <DIV CLASS="form-group">
                <LABEL FOR="stadium">Home Stadium</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="stadium" ID="stadium" ARIA-DESCTIBEDBY="ageHelp" VALUE = "<?php echo $myTeam['stadium']; ?>">
            </DIV>
            <!-- THIS IS NOT SHOWING FOR SOME REASON BECAUSE OF MATERIALIZE -->
            <DIV CLASS="form-group">
                <LABEL FOR="Province">Province</LABEL>
                <SELECT NAME = "province" ID="province" class="browser-default">
                        <OPTION VALUE ="AB">Alberta</OPTION>
                        <OPTION VALUE ="BC" >British Columbia</OPTION>
                        <OPTION VALUE ="MB">Manitoba</OPTION>
                        <OPTION VALUE ="NS">Nova Scotia</OPTION>
                        <OPTION VALUE ="ON">Ontario</OPTION>
                        <OPTION VALUE ="QC">Quebec</OPTION>
                        <OPTION VALUE ="SK">Saskatchewan</OPTION>
                    </SELECT>
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="city">City</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="city" ID="city" ARIA-DESCTIBEDBY="ageHelp" VALUE ="<?php echo $myTeam['city']; ?>">
            </DIV>
        
            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" VALUE="Update Team Information ">
        </DIV>
        <?php 
    }

    // Renders the form to update a coach's information
    static function updateCoachForm($coach, $teams)
    {
         // Verifies if there is any POST data
         if (!empty($_POST))
         {
                
             // Verifies if the ENTIRE FORM was filled in, and if so, creates the new coach
             if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['salary']) && !empty($_POST['team']) && !empty($_POST['dateStarted']) && !empty($_POST['endOfContract']))
             {
                $cm = new coachmapper();
                $cm->update($_POST);
             }
        }

        // Creates an array from which to get the coach's data
        foreach ($coach as $attribute)
        {
             $myCoach = ['coachId'=>$attribute->coachId,
            'fName'=>$attribute->coachFName,
            'lName'=>$attribute->coachLName,
            'salary'=>$attribute->salary,
            'teamName'=>$attribute->teamName,
            'dateStarted'=>$attribute->dateStarted,
            'endOfContract'=>$attribute->endOfContract        
            ];
        }
       
        ?>
        <div class="box content">
        <FORM METHOD="POST" ACTION="">
            <DIV CLASS="form-group">
                <INPUT TYPE="hidden" NAME="coachId" ID="coachId" VALUE="<?php echo $myCoach['coachId'] ?>" />
                <LABEL FOR="firstName">Name</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="firstName" ID="firstName" ARIA-DESCTIBEDBY="firstNameHelp" VALUE = "<?php echo $myCoach['fName']; ?>">
            </DIV>
      
            <DIV CLASS="form-group">
                <LABEL FOR="lastName">Last Name</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="lastName" ID="lastName" ARIA-DESCTIBEDBY="lastNameHelp" VALUE = "<?php echo $myCoach['lName']; ?>">
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="salary">Salary</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="salary" ID="salary" ARIA-DESCTIBEDBY="salaryHelp" VALUE = "<?php echo $myCoach['salary']; ?>">
            </DIV>
            <!-- THIS IS NOT SHOWING FOR SOME REASON BECAUSE OF MATERIALIZE -->
            <DIV CLASS="form-group">
                <LABEL FOR="team">Team</LABEL>
                <SELECT NAME = "team" ID="team" class="browser-default">
                <?php
                    // Loop which populates the select based on the teams that are in the database
                        foreach ($teams as $team)   
                        {
                            echo '<OPTION VALUE = "'.$team->teamName.'">'.$team->teamName.'</OPTION>';
                        } 
                    // Closes the select and continues to print the form
                ?>
                </SELECT>
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="position">Date Started</LABEL>
                <INPUT TYPE="date" CLASS="form-control" NAME="dateStarted" ID="dateStarted" ARIA-DESCTIBEDBY="lastNameHelp" VALUE = "<?php echo $myCoach['dateStarted']; ?>">
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="endOfContract">End of Contract</LABEL>
                <INPUT TYPE="date" CLASS="form-control" NAME="endOfContract" ID="endOfContract" ARIA-DESCTIBEDBY="lastNameHelp" VALUE = "<?php echo $myCoach['endOfContract']; ?>">
            </DIV>

            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" VALUE="Update Coach Information">
            
        </FORM>
        </DIV>

        <?php
    }

    // Renders the search form
    static function searchForm() { ?>
        <form action = "" method = "GET">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input type = "hidden" name = "entity" value = "<?php echo $_GET['entity']; ?>" />
                <input class="mdl-textfield__input" id = "search" type = "text" name = "search" />
                <label class="mdl-textfield__label" for = "search">Search Terms...</label>
            </div>
            <input class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--accent" type = "submit" value = "Go!" />
        </form>
    <?php
    }

    // Renders the form for creating a new player
    static function addPlayerForm($teams) 
    { 
        // Verifies if there is any POST data
        if (!empty($_POST))
        {
            // Verifies if the ENTIRE FORM was filled in, and if so, creates the new player
            if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['age']) && !empty($_POST['team']) && !empty($_POST['position']) && !empty($_POST['nationality']))
            {
                $pm = new playermapper();
                $pm->create($_POST);
            }
            else
            {
                header('Location: DoesntMatter.php?action=createPlayer&message=Please fill in all the fields!');
            }
        }
        
        ?>

        <!-- Beginning of the create player form -->
       <div class="box content">
        <FORM METHOD="POST" ACTION="">
            <DIV CLASS="form-group">
                <LABEL FOR="firstName">First Name</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="firstName" ID="firstNameAdd" ARIA-DESCTIBEDBY="firstNameHelp" >
            </DIV>
      
            <DIV CLASS="form-group">
                <LABEL FOR="lastName">Last Name</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="lastName" ID="lastNameAdd" ARIA-DESCTIBEDBY="lastNameHelp" >
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="age">Age</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="age" maxlength="2" ID="ageAdd" ARIA-DESCTIBEDBY="ageHelp" >
            </DIV>
            <!-- THIS IS NOT SHOWING FOR SOME REASON BECAUSE OF MATERIALIZE -->
            <DIV CLASS="form-group">
                <LABEL FOR="team">Team</LABEL>
                <SELECT NAME = "team" ID="teamAdd" class="browser-default">
                    <?php
                    // Loop which populates the select based on the teams that are in the database
                        foreach ($teams as $team)   
                        {
                            echo '<OPTION VALUE = "'.$team->teamName.'">'.$team->teamName.'</OPTION>';
                        } 
                    // Closes the select and continues to print the form
                    ?>
                </SELECT>
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="position">Position</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="position" ID="positionAdd" ARIA-DESCTIBEDBY="lastNameHelp" >
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="nationality">Nationality</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="nationality" ID="nationalityAdd" ARIA-DESCTIBEDBY="lastNameHelp" >
            </DIV>

            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" VALUE="Create Player">
            
        </FORM>
        </div>
     <?php 
    }
    
    // Renders the form for creating a new team
    static function addTeamForm()
    {   
        // Verifies if there is any POST data
        if (!empty($_POST))
        {
            // Verifies if the ENTIRE FORM was filled in, and if so, creates the new team
            if (!empty($_POST['teamName']) && !empty($_POST['stadium']) && !empty($_POST['province']) && !empty($_POST['city']))
            {
                $tm = new teammapper();
                $tm->create($_POST);
            }
            else
            {
                header('Location: DoesntMatter.php?action=createTeam&message=Please fill in all the fields!');
            }
        }
        
        ?>
        <div class="box content">
            <FORM METHOD="POST" ACTION="">
                <DIV CLASS="form-group">
                    <LABEL FOR="teamName">Team Name</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="teamName" ID="teamName" ARIA-DESCTIBEDBY="firstNameHelp" >
                </DIV>
                <DIV CLASS="form-group">
                    <LABEL FOR="stadium">Home Stadium</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="stadium" ID="stadium" ARIA-DESCTIBEDBY="ageHelp" >
                </DIV>
                <!-- THIS IS NOT SHOWING FOR SOME REASON BECAUSE OF MATERIALIZE -->
                <DIV CLASS="form-group">
                    <LABEL FOR="Province">Province</LABEL>
                    <SELECT NAME = "province" ID="province" class="browser-default">
                        <OPTION VALUE ="AB">Alberta</OPTION>
                        <OPTION VALUE ="BC" selected>British Columbia</OPTION>
                        <OPTION VALUE ="MB">Manitoba</OPTION>
                        <OPTION VALUE ="NS">Nova Scotia</OPTION>
                        <OPTION VALUE ="ON">Ontario</OPTION>
                        <OPTION VALUE ="QC">Quebec</OPTION>
                        <OPTION VALUE ="SK">Saskatchewan</OPTION>
                    </SELECT>
            </DIV>
                <DIV CLASS="form-group">
                    <LABEL FOR="city">City</LABEL>
                    <INPUT TYPE="text" CLASS="form-control" NAME="city" ID="city" ARIA-DESCTIBEDBY="ageHelp" >
                </DIV>
                <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" VALUE="Create Team">
            </FORM>
        </div>
        <?php
    }
    
    // Renders the form for creating a new coach
    static function addCoachForm($teams)
    {
        // Verifies if there is any POST data
        if (!empty($_POST))
        {
            // Verifies if the ENTIRE FORM was filled in, and if so, creates the new coach
            if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['salary']) && !empty($_POST['team']) && !empty($_POST['dateStarted']) && !empty($_POST['endOfContract']))
            {
                $cm = new coachmapper();
                $cm->create($_POST);
            }
            else
            {
                header('Location: DoesntMatter.php?action=createCoach&message=Please fill in all the fields!');
            }
        }

        ?>
        <div class="box content">
        <FORM METHOD="POST" ACTION="">
            <DIV CLASS="form-group">
                <LABEL FOR="firstName">Name</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="firstName" ID="firstName" ARIA-DESCTIBEDBY="firstNameHelp" >
            </DIV>
      
            <DIV CLASS="form-group">
                <LABEL FOR="lastName">Last Name</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="lastName" ID="lastName" ARIA-DESCTIBEDBY="lastNameHelp" >
            </DIV>

            <DIV CLASS="form-group">
                <LABEL FOR="salary">Salary</LABEL>
                <INPUT TYPE="text" CLASS="form-control" NAME="salary" ID="salary" ARIA-DESCTIBEDBY="salaryHelp" >
            </DIV>
            <!-- THIS IS NOT SHOWING FOR SOME REASON BECAUSE OF MATERIALIZE -->
            <DIV CLASS="form-group">
                <LABEL FOR="team">Team</LABEL>
                <SELECT NAME = "team" ID="team" class="browser-default">
                <?php
                // Loop which populates the select based on the teams that are in the database
                    foreach ($teams as $team)   
                    {
                        echo '<OPTION VALUE = "'.$team->teamName.'">'.$team->teamName.'</OPTION>';
                    } 
                // Closes the select and continues to print the form
                ?>
                </SELECT>
            </DIV>
            <DIV CLASS="form-group">
                <LABEL FOR="position">Date Started</LABEL>
                <INPUT TYPE="date" CLASS="form-control" NAME="dateStarted" ID="dateStarted" ARIA-DESCTIBEDBY="lastNameHelp" >
            </DIV>
            <DIV CLASS="form-group">
                <LABEL FOR="endOfContract">End of Contract</LABEL>
                <INPUT TYPE="date" CLASS="form-control" NAME="endOfContract" ID="endOfContract" ARIA-DESCTIBEDBY="lastNameHelp" >
            </DIV>
            <INPUT CLASS="btn btn-primary" TYPE="SUBMIT" VALUE="Create Coach">
        </FORM>
        </div>
        <?php
    }

    // Renders the statistics content for the players
    static function showPlayersStatistics($teams) 
    { 
        if ($teams != null)
        {
            // The input used is called TEAMS because we get the amount of player PER TEAM        
            ?>

                <DIV class = "box stat">Statistics:
                    <br />
                    <table>
                        <tr>
                            <th> Teams </th>
                            <th> # of players </th>
                        </tr>
                        <?php
                            foreach ($teams as $team)
                            {
                                echo '<tr><td>'.$team->teamName.'</td>';
                                echo '<td>'.$team->qtyOfPlayers.'</td></tr>';
                            }
                    ?>
                    </table>
                
                </DIV>

            <?php 
        }
    }    

    // Renders the statistics content for the teams
    static function showTeamsStatistics($provinces) 
    { 
        if ($provinces != null)
        {

            // The input used is called PROVINCES because we get the amount of TEAMS per PROVINCE  
            ?>

                <DIV class = "box stat">Statistics:
                    <table>
                        <tr>
                            <th> Province </th>
                            <th> # of teams </th>
                        </tr>
                    <?php
                        foreach ($provinces as $province)
                        {
                            switch ($province->province)
                            {
                                case "AB":
                                $provinceName = "Alberta";
                                break;
                                case "BC":
                                $provinceName = "British Columbia";
                                break;
                                case "MB":
                                $provinceName = "Manitoba";
                                break;
                                case "NS":
                                $provinceName = "Nova Scotia";
                                break;
                                case "ON":
                                $provinceName = "Ontario";
                                break;
                                case "QC":
                                $provinceName = "Quebec";
                                break;
                                case "SK":
                                $provinceName = "Saskatchewan";
                                break;

                            }
                            echo '<tr><td>'.$provinceName.'</td>';
                            echo '<td>'.$province->qtyOfTeams.'</td></tr>';
                        }
                    ?>
                    </table>
                
                
                </DIV>

            <?php 
        }
    }  

    // Renders the statistics content for the teams
    static function showCoachesStatistics($teams) 
    { 
        if ($teams != null)
        {
            // The input used is called PROVINCES because we get the amount of COACHES per TEAM
            // Soccer teams can have multiple coaches by the way  
            ?>

                <DIV class = "box stat">Statistics:
                    <table>
                        <tr>
                            <th> Teams </th>
                            <th> # of coaches </th>
                        </tr>
                        <?php
                            foreach ($teams as $team)
                            {
                                echo '<tr><td>'.$team->teamName.'</td>';
                                echo '<td>'.$team->qtyOfCoaches.'</td></tr>';
                            }
                        ?>
                    </table>
                </DIV>
            <?php 
        }
    }  

    // Renders the 3 clocks at the bottom by using HTML CANVAS and connecting it to our API
    static function showClocks() 
    { ?>

      <div class="box clock" style="display: flex; justify-content: space-evenly">
      <script>
        class Clock {
            constructor(label) {
                this._time = null;
                this.label = label;
                this.canvas = document.createElement("canvas");
                this.canvas.width = 200;
                this.canvas.height = 200;
                this.ctx = this.canvas.getContext("2d");
                this.radius = this.canvas.height / 2;
                this.ctx.translate(this.radius, this.radius);
                this.radius = this.radius * 0.90;
            }

            get time() {
                return this._time;
            }

            get canvasRef() {
                return this.canvas;
            }

            start(t0) {
                this._time = new Date(t0);
                var timerId = setInterval(() => {
                    this._time = new Date(this._time.getTime() + 1000);
                    this.drawClock();
                }, 1000);
                
                return () => {
                    clearInterval(timerId);
                }
            }

            drawClock() {
                this.drawFace();
                this.drawNumbers();
                this.drawLabel();
                this.drawTime();
            }

            drawFace() {
                var grad;
                var ctx = this.ctx;
                var radius = this.radius;
                ctx.beginPath();
                ctx.arc(0, 0, radius, 0, 2*Math.PI);
                ctx.fillStyle = 'white';
                ctx.fill();
                grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
                grad.addColorStop(0, '#333');
                grad.addColorStop(0.5, 'white');
                grad.addColorStop(1, '#333');
                ctx.strokeStyle = grad;
                ctx.lineWidth = radius*0.1;
                ctx.stroke();
                ctx.beginPath();
                ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
                ctx.fillStyle = '#333';
                ctx.fill();
            }

            drawNumbers() {
                var ang;
                var num;
                var ctx = this.ctx;
                var radius = this.radius;
                ctx.font = radius*0.15 + "px arial";
                ctx.textBaseline="middle";
                ctx.textAlign="center";
                for(num = 1; num < 13; num++){
                    ang = num * Math.PI / 6;
                    ctx.rotate(ang);
                    ctx.translate(0, -radius*0.85);
                    ctx.rotate(-ang);
                    ctx.fillText(num.toString(), 0, 0);
                    ctx.rotate(ang);
                    ctx.translate(0, radius*0.85);
                    ctx.rotate(-ang);
                }
            }
            
            drawLabel() {
                this.ctx.font = "14px sans-serif";
                this.ctx.fillText(this.label, 0, -50);
            }

            drawTime(){
                var ctx = this.ctx;
                var radius = this.radius;
                var now = this.time;
                var hour = now.getHours();
                var minute = now.getMinutes();
                var second = now.getSeconds();
                //hour
                hour=hour%12;
                hour=(hour*Math.PI/6)+
                (minute*Math.PI/(6*60))+
                (second*Math.PI/(360*60));
                this.drawHand(hour, radius*0.5, radius*0.07);
                //minute
                minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
                this.drawHand(minute, radius*0.8, radius*0.07);
                // second
                // second=(second*Math.PI/30);
                // this.drawHand(second, radius*0.9, radius*0.02);
            }

            drawHand(pos, length, width) {
                var ctx = this.ctx;
                ctx.beginPath();
                ctx.lineWidth = width;
                ctx.lineCap = "round";
                ctx.moveTo(0,0);
                ctx.rotate(pos);
                ctx.lineTo(0, -length);
                ctx.stroke();
                ctx.rotate(-pos);
            }
        }
        

        // Gets the data from the API and renders 3 clocks from it
        var zones = {
            Vancouver: 'PDT',
            Calgary: 'MDT',
            Ottawa: 'EDT',
        };

        var clockBox = document.querySelector('.box.clock');
        var renderNext = (cities) => {
            const city = cities.pop();
            if(!city) {
                return
            }
            const clock = new Clock(city);
            clockBox.appendChild(clock.canvasRef);
            fetch(`api/time.php?zone=${zones[city]}`)
                .then(res => res.json())
                .then(json => {
                    clock.start(json.formatted)
                    // api limit 1 request per second
                    setTimeout(() => renderNext(cities), 1000)
                })
        }

        renderNext(Object.keys(zones))
      </script>
      </div>

    <?php }

    static function showMessage($message)
    {
        echo '<DIV CLASS="alert alert-success">'.$message.'</DIV>';
    }

    // Renders the page footer
    static function footer() { ?>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      </div>
    </body>
  </html>
    <?php
    } 
}
?>