<?php
/**
 * Group Name : Doesnt Matter
 * Students:
 * Joao Vitor Wilke Silva 300278748
 * Alina Pak 300277280
 * Sergei Bisborodov 300264653
 * 
 */

// Requires the files
require_once("inc/config.inc.php");
require_once("inc/PDOAgent.class.php");
require_once("inc/Page.class.php");
require_once("inc/Playermapper.class.php");
require_once("inc/Teammapper.class.php");
require_once("inc/Coachmapper.class.php");

// Sets the page title
Page::$title = "Doesn't matter";

// Renders the page header
Page::header();

// Instantiate the mappers for the 3 entities (Players, Teams and Coaches)
$pm = new playermapper();
$tm = new teammapper();
$cm = new coachmapper();

if (!empty($_GET))
{
    // Verifies that one of the entities was selected by clicking the link
    if (isset($_GET['entity']))
    {
        // Renders the "search for terms form 
        Page::searchForm();
        // Verifies which link was selected in order to display the appropriate entity's information
        switch ($_GET['entity'])
        {
            // If PLAYERS was selected
            case 'players':
                // Verifies if the user input any search terms, and if so renders a table with the PLAYERS that partially and/or fully match the search term(s)
                if (!empty($_GET['search']))
                {
                    Page::createTablePlayers($pm->listAllWithSearch($_GET['search']));
                }
                // If no search term(s) were provided,  renders the complete PLAYERS table
                else
                {
                    Page::createTablePlayers($pm->listAll());
                }
                // Displays players' statistics
                Page::showPlayersStatistics($pm->getStatistics());
                break;
            // If TEAMS was selected
            case 'teams':
                // Verifies if the user input any search terms, and if so, renders a table with the TEAMS that partially and/or fully match the search term(s)
                if (!empty($_GET['search']))
                {
                    Page::createTableTeams($tm->listAllWithSearch($_GET['search']));
                }
                // If no search term(s) were provided, renders the complete TEAMS table
                else
                {
                    Page::createTableTeams($tm->listAll());
                }
                // Displays teams' statistics
                Page::showTeamsStatistics($tm->getStatistics());
                break;
            // If COACHES was selected
            case 'coaches':
                // Verifies if the user input any search terms, and if so renders a table with the COACHES that partially and/or fully match the search term(s)
                if (!empty($_GET['search']))
                {
                    Page::createTableCoaches($cm->listAllWithSearch($_GET['search']));
                }
                // If no search term(s) were provided, renders the complete COACHES table
                else
                {
                    Page::createTableCoaches($cm->listAll());
                }
                // Displays coaches' statistics
                Page::showCoachesStatistics($cm->getStatistics());                 
                break;
        }        
    }
    // Verifies if the user clicked on "ADD, UPDATE OR DELETE" in ANY of the entities
    else if (isset($_GET['action']))
    {
        switch ($_GET['action'])
        {
            // Renders the form to update the selected player
            case 'updatePlayer':
                Page::updatePlayerForm($pm->listOne($_GET['playerID']),$tm->listAll());
                break;
            // Renders the form to update the selected team 
            case 'updateTeam':
                Page::updateTeamForm($tm->listOne($_GET['teamID']));
                break;
            // Renders the form to update the selected coach - jvws
            case 'updateCoach':
                Page::updateCoachForm($cm->listOne($_GET['coachID']),$tm->listAll());
                break;
            // Calls the function to delete the selected player and renders the player table
            case 'deletePlayer':
                $pm->delete($_GET['playerID']);
                Page::createTablePlayers($pm->listAll());
                break;
            // Calls the function to delete the selected team and renders the team table
            case 'deleteTeam':
               $tm->delete($_GET['teamID']);
                Page::createTableTeams($tm->listAll());
                break;
            // Calls the function to delete the selected coach and render the coach table
            case 'deleteCoach':
                $cm->delete($_GET['coachID']);
                Page::createTableCoaches($cm->listAll());
                break;
            case 'createPlayer':
            //  Renders the form to add a new player
                Page::addPlayerForm($tm->listAll());    
                break;
            case 'createTeam':
            // Renders the form to add a new team
                Page::addTeamForm();    
                break;
            case 'createCoach':
            // Renders a form to add a new coach
                Page::addCoachForm($tm->listAll());    
                break;
        }
    }
}

/**Renders the clocks at the bottom of the page
 * The clocks are rendered via HTML Canvas(New technology 2)
 * and the times used in the clocks come from the API we used * 
 */
Page::showClocks();

// Renders the page footer 
Page::footer();

?>
