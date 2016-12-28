<?php
class LiquiGoals_QueryHelper
{
	protected $pdo;

	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function getUserEditCount($user_id, array $filters = [])
	{
		$joins  = [];
		$wheres = [];
		$params = [];

		if (isset($filters['category_title']))
		{
			$joins[]  = $this->prefixTableName('categorylinks') . ' cl ON cl.cl_type = \'page\' AND cl.cl_from = r.rev_page';
			$wheres[] = 'cl.cl_to = :category_title';
			$params[':category_title'] = $filters['category_title'];
		}

		if (isset($filters['page_body_regex']))
		{
			$wheres[] = 't.old_text REGEXP :page_body_regex';
			$params[':page_body_regex'] = $filters['page_body_regex'];
		}

		$sql = '
			SELECT LENGTH(t.old_text) AS new_text_length, LENGTH(pt.old_text) AS old_text_length
			FROM ' . $this->prefixTableName('revision') . ' r
			JOIN ' . $this->prefixTableName('text') . ' t ON r.rev_text_id = t.old_id
			JOIN ' . $this->prefixTableName('revision') . ' pr ON r.rev_parent_id = pr.rev_id
			JOIN ' . $this->prefixTableName('text') . ' pt ON pr.rev_text_id = pt.old_id';
		if (count($joins) > 0)
			$sql .= ' JOIN ' . join(' JOIN ', $joins);
		$sql .= '
			WHERE r.rev_user = :user_id';
		if (count($wheres) > 0)
			$sql .= ' AND ' . join(' AND ', $wheres);
		$sql .= '
			HAVING ABS(new_text_length - old_text_length) > :min_edit_length';

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id,
			':min_edit_length' => LiquiGoals::getConfigValue('MinEditLength')
		]));

		return $query->rowCount();
	}

	public function getUserMaxEditLength($user_id, array $filters = [])
	{
		$joins  = [];
		$wheres = [];
		$params = [];

		if (isset($filters['category_title']))
		{
			$joins[]  = $this->prefixTableName('categorylinks') . ' cl ON cl.cl_type = \'page\' AND cl.cl_from = r.rev_page';
			$wheres[] = 'cl.cl_to = :category_title';
			$params[':category_title'] = $filters['category_title'];
		}

		$sql = '
			SELECT MAX(LENGTH(t.old_text) - LENGTH(pt.old_text)) AS max_edit_length
			FROM ' . $this->prefixTableName('revision') . ' r
			JOIN ' . $this->prefixTableName('text') . ' t ON r.rev_text_id = t.old_id
			JOIN ' . $this->prefixTableName('revision') . ' pr ON r.rev_parent_id = pr.rev_id
			JOIN ' . $this->prefixTableName('text') . ' pt ON pr.rev_text_id = pt.old_id';
		if (count($joins) > 0)
			$sql .= ' JOIN ' . join(' JOIN ', $joins);
		$sql .= '
			WHERE r.rev_user = :user_id';
		if (count($wheres) > 0)
			$sql .= ' AND ' . join(' AND ', $wheres);
		$sql .= '
			GROUP BY r.rev_user';

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id
		]));
		return $query->fetchColumn(0) ?: 0;
	}

	public function getUserMaxBumpDays($user_id, array $filters = [])
	{
		$joins  = [];
		$wheres = [];
		$params = [];

		if (isset($filters['category_title']))
		{
			$joins[]  = $this->prefixTableName('categorylinks') . ' cl ON cl.cl_type = \'page\' AND cl.cl_from = r.rev_page';
			$wheres[] = 'cl.cl_to = :category_title';
			$params[':category_title'] = $filters['category_title'];
		}

		$sql = '
			SELECT MAX(DATEDIFF(STR_TO_DATE(r.rev_timestamp, \'%Y%m%d%H%i%s\'), STR_TO_DATE(pr.rev_timestamp, \'%Y%m%d%H%i%s\'))) AS max_bump_days
			FROM ' . $this->prefixTableName('revision') . ' r
			JOIN ' . $this->prefixTableName('revision') . ' pr ON r.rev_parent_id = pr.rev_id';
		if (count($joins) > 0)
			$sql .= ' JOIN ' . join(' JOIN ', $joins);
		$sql .= '
			WHERE r.rev_user = :user_id';
		if (count($wheres) > 0)
			$sql .= ' AND ' . join(' AND ', $wheres);
		$sql .= '
			GROUP BY r.rev_user';

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id
		]));
		return $query->fetchColumn(0) ?: 0;
	}

	public function getUserMaxEditStreak($user_id, array $filters = [])
	{
		$joins  = [];
		$wheres = [];
		$params = [];

		if (isset($filters['category_title']))
		{
			$joins[]  = $this->prefixTableName('categorylinks') . ' cl ON cl.cl_type = \'page\' AND cl.cl_from = r.rev_page';
			$wheres[] = 'cl.cl_to = :category_title';
			$params[':category_title'] = $filters['category_title'];
		}

		$sql = '
			SELECT streak
			FROM (
				SELECT IF(@prevDate + INTERVAL 1 DAY = current.date, @currentStreak := @currentStreak + 1, @currentStreak := 1) AS streak, @prevDate := current.date
				FROM (
					SELECT CONVERT(r.rev_timestamp, DATE) AS date
					FROM ' . $this->prefixTableName('revision') . ' r';

		if (count($joins) > 0)
		$sql .= '
					JOIN ' . join(' JOIN ', $joins);
		$sql .= '
					WHERE r.rev_user = :user_id';
		if (count($wheres) > 0)
			$sql .= '
					AND ' . join(' AND ', $wheres);

		$sql .= '
					GROUP BY date
					ORDER BY date
				) AS current
				INNER JOIN (SELECT @prevDate := NULL, @currentStreak := 1) AS vars
			) AS _

			ORDER BY streak DESC LIMIT 1';

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id
		]));

		return $query->fetchColumn(0) ?: 0;
	}

	protected function prefixTableName($name)
	{
		return isset($GLOBALS['wgDBprefix']) ? $GLOBALS['wgDBprefix'] . $name : $name;
	}
}
