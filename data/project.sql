DROP DATABASE IF EXISTS project;

CREATE DATABASE IF NOT EXISTS project;

USE project;

CREATE TABLE Teams (
    teamId INT(2) NOT NULL AUTO_INCREMENT,
    teamName VARCHAR(30) NOT NULL UNIQUE,
    province VARCHAR(2) NOT NULL,
    city VARCHAR(20) NOT NULL,
    stadium VARCHAR(25) NOT NULL,
    CONSTRAINT  Team_PK PRIMARY KEY(teamId)
) ENGINE=InnoDB; 

CREATE TABLE Players(
    playerId INT(2) NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(10) NOT NULL,
    lastName VARCHAR(15) NOT NULL,
    age INT(2) NOT NULL,
    teamName VARCHAR(30) NOT NULL,
    position VARCHAR(15) NOT NULL,
    nationality VARCHAR(20) NULL,
    CONSTRAINT 	Players_PK PRIMARY KEY(playerId),
    CONSTRAINT Players_FK FOREIGN KEY(teamName)
                                    REFERENCES Teams(teamName) 
                                    ON UPDATE CASCADE
									ON DELETE CASCADE
) ENGINE=InnoDB; 

CREATE TABLE Coaches (
    coachId INT(2) NOT NULL AUTO_INCREMENT,
    coachFName VARCHAR(20) NOT NULL,
    coachLName VARCHAR(30) NOT NULL,
    salary VARCHAR(10) NOT NULL,
    teamName VARCHAR(30) NOT NULL,
    dateStarted DATE NOT NULL,
    endOfContract DATE NOT NULL,
    CONSTRAINT Coaches_PK PRIMARY KEY(coachId),
    CONSTRAINT Coaches_FK FOREIGN KEY(teamName)
                                        REFERENCES Teams(teamName)
                                        ON UPDATE CASCADE
										ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO Teams (teamName, province, city, stadium) 
values('Vancouver Whitecaps FC', 'BC', 'Vancouver', 'BC Place');
INSERT INTO Teams (teamName, province, city, stadium)
values('Montreal Impact', 'QC', 'Montreal', 'Saputo Stadium');
INSERT INTO Teams (teamName, province, city, stadium)
values('Ottawa Fury FC', 'ON', 'Ottawa', 'BMO Field');
INSERT INTO Teams (teamName, province, city, stadium)
values('Toronto FC', 'ON', 'Toronto', 'BMO Field');
INSERT INTO Teams (teamName, province, city, stadium)
values('Calgary Callies ', 'AB', 'Edmonds', 'Spruce Meadows');

INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Stefan', 'Marinovic', 26, 'Vancouver Whitecaps FC', 'goalkeeper',  'Brazilian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Doneil', 'Henry', 25, 'Vancouver Whitecaps FC', 'defender', 'Canadian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Sean', 'Franklin', 33, 'Vancouver Whitecaps FC', 'defender', 'Canadian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Kendall', 'Waston', 30, 'Vancouver Whitecaps FC', 'defender', 'Canadian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Efrain', 'Juarez', 30, 'Vancouver Whitecaps FC', 'midfielder', 'Canadian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Bernie', 'Ibini', 25, 'Vancouver Whitecaps FC', 'forward', 'Canadian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Felipe', 'Martins', 27, 'Vancouver Whitecaps FC', '	midfielder', 'Canadian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Anthony', 'Blondell', 24, 'Vancouver Whitecaps FC', 'forward', 'Canadian');

INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Alex', 'Doe', 27, 'Montreal Impact', 'forward','Brazilian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Sam', 'Smith', 24, 'Montreal Impact', 'goalkeeper','Brazilian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('John', 'Karanovskyi', 30, 'Montreal Impact', 'midfielder','Brazilian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Simon', 'Linear', 28, 'Montreal Impact', 'defender','Brazilian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Stephan', 'Varun', 29, 'Montreal Impact', 'defender','Brazilian');

INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Jack', 'Smith', 27, 'Toronto FC', 'forward','Russian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Bruno', 'Ageda', 24, 'Toronto FC', 'goalkeeper','Russian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Cristian', 'Frederick', 30, 'Toronto FC', 'midfielder','Russian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Carlos', 'Simson', 28, 'Toronto FC', 'defender','Russian');
INSERT INTO Players (firstName, lastName, age, teamName, position, nationality) 
values('Robert', 'Homls', 29, 'Toronto FC', 'midfielder','Russian');

INSERT INTO Coaches (coachFName, coachLName, salary, teamName, dateStarted, endOfContract) 
VALUES('Robert', 'Johnson', 250000, 'Toronto FC', '2000-10-21', '2020-04-08');
INSERT INTO Coaches (coachFName, coachLName, salary, teamName, dateStarted, endOfContract) 
VALUES('Fred', 'Hemmengew', 320000, 'Montreal Impact', '2004-12-31', '2021-03-01');
INSERT INTO Coaches (coachFName, coachLName, salary, teamName, dateStarted, endOfContract) 
VALUES('Matthew', 'Stopp', 280000, 'Montreal Impact', '2004-01-25', '2022-03-22');
INSERT INTO Coaches (coachFName, coachLName, salary, teamName, dateStarted, endOfContract) 
VALUES('Carlos', 'Sopranos', 220000, 'Toronto FC', '2004-12-08', '2023-09-01');
INSERT INTO Coaches (coachFName, coachLName, salary, teamName, dateStarted, endOfContract) 
VALUES('William', 'Tannyron', 350000, 'Vancouver Whitecaps FC', '2004-04-14', '2021-08-21');