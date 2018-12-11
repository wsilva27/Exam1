SELECT T3.TEAM_NAME, COUNT(T1.PLAYER_ID) AS GOALS
	FROM PLAYER AS T1
	INNER JOIN SCORE AS T2 ON T1.PLAYER_ID=T2.PLAYER_ID
	INNER JOIN TEAM AS T3 ON T1.TEAM_ID=T3.TEAM_ID
GROUP BY T3.TEAM_NAME
ORDER BY T3.TEAM_NAME

-- Although the answer seems correct, there are some problems with the question.
-- Because if one of the teams does not have a score, the team will be excluded in the result.
-- Therefore, the query must be created using left join based on the team.
