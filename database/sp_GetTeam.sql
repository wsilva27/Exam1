<<<<<<< HEAD
DELIMITER $$
CREATE PROCEDURE GetTeam()
BEGIN
SELECT DISTINCT TEAM_NAME
	FROM TEAM
	WHERE TEAM_NAME <> ""
	ORDER BY TEAM_NAME;
END $$
=======
DELIMITER $$
CREATE PROCEDURE GetTeam()
BEGIN
SELECT DISTINCT TEAM_NAME
	FROM TEAM
	WHERE TEAM_NAME <> ""
	ORDER BY TEAM_NAME;
END $$
>>>>>>> 9e309c29616244bce0c5392e1c4136725233f68f
DELIMITER ;