CREATE VIEW MATCH_SCORES AS
select 
	res3.match_id, sum(team1) as team1_score, sum(team2) as team2_score, id1, id2
from (
	select 
		m.match_id, ifnull(res1.score, 0) as team1, null as team2, m.team_id_1 as id1, m.team_id_2 as id2
	from 
		matches m
	left join (
		select 
			s.match_id, t.team_id, count(t.team_id) as score
		from
			score s
		inner join
			player p
		on
			s.player_id = p.player_id
		inner join
			team t
		on
			p.team_id = t.team_id
		group by
			s.match_id, t.team_id
	) res1
	on 
		m.match_id = res1.match_id and m.team_id_1 = res1.team_id
	union
	select 
		m.match_id, null as team1, ifnull(res2.score, 0) as team2, m.team_id_1 as id1, m.team_id_2 as id2
	from 
		matches m
	left join (
		select 
			s.match_id, t.team_id, count(t.team_id) as score
		from
			score s
		inner join
			player p
		on
			s.player_id = p.player_id
		inner join
			team t
		on
			p.team_id = t.team_id
		group by
			s.match_id, t.team_id
	) res2
	on 
		m.match_id = res2.match_id and m.team_id_2 = res2.team_id

) res3
group by 
	res3.match_id