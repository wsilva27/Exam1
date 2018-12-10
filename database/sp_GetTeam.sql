DELIMITER $$
CREATE PROCEDURE GetTeam()
BEGIN
SELECT DISTINCT TEAM_NAME
	FROM TEAM
	WHERE TEAM_NAME <> ""
	ORDER BY TEAM_NAME;
END $$
DELIMITER ;