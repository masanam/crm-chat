select
  t.id,
  t.status_id,
  ss.name,
  c.name,
  o.name,
  count(distinct t.id)
from
  tasks t
  join statuses ss on ss.id = t.status_id
  join clients c on c.id = t.client_id
  join organizations o on o.id = c.organization_id
group by
  t.status_id;
  
truncate task_statuses restart identity;

WITH
  task_counts AS (
    SELECT
      t.status_id,
      ss.name AS status_name,
			c.name as client_name,
		  o.name as organization_name,
    	COUNT(t.id) AS task_count
    FROM
      tasks t
      JOIN task_statuses ss ON ss.id = t.status_id
      join clients c on c.id = t.client_id
      join organizations o on o.id = c.organization_id
    GROUP BY
      t.status_id,
      ss.name,
    c.name,
    o.name
  )
SELECT
  *
FROM
  task_counts
ORDER BY
  status_id;
  
select t.status_id, ss.name as status_name, c.name as client_name, o.name as organization_name, COUNT(t.id) as task_count from "tasks" as "t" inner join "task_statuses" as "ss" on "ss"."id" = "t"."status_id" inner join "clients" as "c" on "c"."id" = "t"."client_id" inner join "organizations" as "o" on "o"."id" = "c"."organization_id" group by "t"."status_id", "ss"."name", "c"."name", "o"."name" order by "t"."status_id" asc