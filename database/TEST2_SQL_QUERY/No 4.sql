-- Match_id is a field for verification.

SELECT
	M.MATCH_ID, T.TEAM_NAME, P.PLAYER_NAME, P.JERSEY_NUMBER, 
	M.MATCH_DATE, MIN(S.GOAL_TIME) AS GOAL_TIME
FROM
	SCORE S
INNER JOIN
	PLAYER P
ON
	S.PLAYER_ID = P.PLAYER_ID
INNER JOIN
	TEAM T
ON
	P.TEAM_ID = T.TEAM_ID
INNER JOIN
	MATCHES M
ON
	S.MATCH_ID = M.MATCH_ID
GROUP BY
	S.MATCH_ID
ORDER BY
	S.MATCH_ID ASC
