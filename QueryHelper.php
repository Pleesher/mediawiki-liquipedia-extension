<?php
class LiquiGoals_QueryHelper
{
	protected $pdo;

	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function getUserPageCreationCount($user_id, array $filters = [])
	{
		static $result_cache = [];
		$parameters_encoded = json_encode(func_get_args());
		if (isset($result_cache[$parameters_encoded]))
			return $result_cache[$parameters_encoded];

		$joins  = [];
		$wheres = [];
		$params = [];

		$this->applyEditFilters($filters, $joins, $wheres, $params);

		$sql = '
			SELECT COUNT(*)
			FROM ' . $this->prefixTableName('revision') . ' r';
		if (count($joins) > 0)
			$sql .= ' JOIN ' . join(' JOIN ', $joins);
		$sql .= '
			WHERE r.rev_user = :user_id
			AND   r.rev_parent_id = 0
			AND   r.rev_deleted = 0';
		if (count($wheres) > 0)
			$sql .= ' AND ' . join(' AND ', $wheres);

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id
		]));

		$result_cache[$parameters_encoded] = (int)$query->fetchColumn(0) ?: 0;
		return $result_cache[$parameters_encoded];
	}

	public function getUserEditCount($user_id, array $filters = [])
	{
		static $result_cache = [];
		$parameters_encoded = json_encode(func_get_args());
		if (isset($result_cache[$parameters_encoded]))
			return $result_cache[$parameters_encoded];

		$joins  = [];
		$wheres = [];
		$params = [];

		$this->applyEditFilters($filters, $joins, $wheres, $params);

		$sql = '
			SELECT COUNT(*)
			FROM ' . $this->prefixTableName('revision') . ' r';
		if (count($joins) > 0)
			$sql .= ' JOIN ' . join(' JOIN ', $joins);
		$sql .= '
			WHERE r.rev_user = :user_id
			AND   r.rev_parent_id <> 0
			AND   r.rev_deleted = 0';
		if (count($wheres) > 0)
			$sql .= ' AND ' . join(' AND ', $wheres);

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id
		]));

		$result_cache[$parameters_encoded] = (int)$query->fetchColumn(0) ?: 0;
		return $result_cache[$parameters_encoded];
	}

	public function getUserMaxEditLength($user_id, array $filters = [])
	{
		static $result_cache = [];
		$parameters_encoded = json_encode(func_get_args());
		if (isset($result_cache[$parameters_encoded]))
			return $result_cache[$parameters_encoded];

		$joins  = [];
		$wheres = [];
		$params = [];

		$this->applyEditFilters($filters, $joins, $wheres, $params);

		$sql = '
			SELECT MAX(LENGTH(t.old_text) - LENGTH(pt.old_text)) AS max_edit_length
			FROM ' . $this->prefixTableName('revision') . ' r
			JOIN ' . $this->prefixTableName('text') . ' t ON r.rev_text_id = t.old_id
			JOIN ' . $this->prefixTableName('revision') . ' pr ON r.rev_parent_id = pr.rev_id
			JOIN ' . $this->prefixTableName('text') . ' pt ON pr.rev_text_id = pt.old_id';
		if (count($joins) > 0)
			$sql .= ' JOIN ' . join(' JOIN ', $joins);
		$sql .= '
			WHERE r.rev_user = :user_id
			AND   r.rev_deleted = 0';
		if (count($wheres) > 0)
			$sql .= ' AND ' . join(' AND ', $wheres);
		$sql .= '
			GROUP BY r.rev_user';

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id
		]));

		$result_cache[$parameters_encoded] = (int)$query->fetchColumn(0) ?: 0;
		return $result_cache[$parameters_encoded];
	}

	public function getUserMaxBumpDays($user_id, array $filters = [])
	{
		static $result_cache = [];
		$parameters_encoded = json_encode(func_get_args());
		if (isset($result_cache[$parameters_encoded]))
			return $result_cache[$parameters_encoded];

		$joins  = [];
		$wheres = [];
		$params = [];

		$this->applyEditFilters($filters, $joins, $wheres, $params);

		$sql = '
			SELECT MAX(DATEDIFF(STR_TO_DATE(r.rev_timestamp, \'%Y%m%d%H%i%s\'), STR_TO_DATE(pr.rev_timestamp, \'%Y%m%d%H%i%s\'))) AS max_bump_days
			FROM ' . $this->prefixTableName('revision') . ' r
			JOIN ' . $this->prefixTableName('revision') . ' pr ON r.rev_parent_id = pr.rev_id';
		if (count($joins) > 0)
			$sql .= ' JOIN ' . join(' JOIN ', $joins);
		$sql .= '
			WHERE r.rev_user = :user_id
			AND   r.rev_deleted = 0';
		if (count($wheres) > 0)
			$sql .= ' AND ' . join(' AND ', $wheres);
		$sql .= '
			GROUP BY r.rev_user';

		$query = $this->pdo->prepare($sql);
		$query->execute(array_merge($params, [
			':user_id' => $user_id
		]));

		$result_cache[$parameters_encoded] = (int)$query->fetchColumn(0) ?: 0;
		return $result_cache[$parameters_encoded];
	}

	public function getUserMaxEditStreak($user_id, array $filters = [])
	{
		static $result_cache = [];
		$parameters_encoded = json_encode(func_get_args());
		if (isset($result_cache[$parameters_encoded]))
			return $result_cache[$parameters_encoded];

		$joins  = [];
		$wheres = [];
		$params = [];

		$this->applyEditFilters($filters, $joins, $wheres, $params);

		$sql = '
			SELECT streak
			FROM (
				SELECT IF(@prevDate + INTERVAL 1 DAY = current.date, @currentStreak := @currentStreak + 1, @currentStreak := 1) AS streak, @prevDate := current.date
				FROM (
					SELECT CONVERT(CONVERT_TZ(CONVERT(r.rev_timestamp, DATETIME), \'+00:00\', \'' . $this->getTimezoneOffset() . '\'), DATE) AS date
					FROM ' . $this->prefixTableName('revision') . ' r';

		if (count($joins) > 0)
		$sql .= '
					JOIN ' . join(' JOIN ', $joins);
		$sql .= '
					WHERE r.rev_user = :user_id
					AND   r.rev_parent_id <> 0
					AND   r.rev_deleted = 0';
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

		$result_cache[$parameters_encoded] = (int)$query->fetchColumn(0) ?: 0;
		return $result_cache[$parameters_encoded];
	}

	protected function applyEditFilters(array $filters, array &$joins, array &$wheres, array &$params)
	{
		$joins[] = $this->prefixTableName('page') . ' p ON r.rev_page = p.page_id';

		if (isset($filters['category_title']))
		{
			$joins[] = $this->prefixTableName('categorylinks') . ' cl ON cl.cl_type = \'page\' AND cl.cl_from = r.rev_page';
			$wheres[] = 'cl.cl_to = :category_title';
			$params[':category_title'] = $filters['category_title'];
		}

		if (isset($filters['body_regex']))
		{
			$wheres[] = 't.old_text REGEXP :body_regex';
			$params[':body_regex'] = $filters['body_regex'];
		}

		if (isset($filters['page_title_regex']))
		{
			$wheres[] = 'p.page_title REGEXP :page_title_regex';
			$params[':page_title_regex'] = $filters['page_title_regex'];
		}

		if (isset($filters['page_title_negative_regex']))
		{
			$wheres[] = 'p.page_title REGEXP :page_title_negative_regex = 0';
			$params[':page_title_negative_regex'] = $filters['page_title_negative_regex'];
		}

		if (isset($filters['namespace']))
		{
			$namespaces = (array)$filters['namespace'];
			if (count($namespaces) == 1)
			{
				$wheres[] = 'p.page_namespace = :namespace';
				$params[':namespace'] = (int)reset($namespaces);
			}
			else
				$wheres[] = 'p.page_namespace IN (' . join(', ', array_map(function($namespace) { return (int)$namespace; }, $namespaces)) . ')';
		}

		if (isset($filters['_where']))
			$wheres[] = $filters['_where'];

		if (isset($filters['_where_params']))
			$params = array_merge($params, $filters['_where_params']);
	}

	protected function prefixTableName($name)
	{
		return isset($GLOBALS['wgDBprefix']) ? $GLOBALS['wgDBprefix'] . $name : $name;
	}

	protected function getTimezoneOffset()
	{
		$minutes = (new DateTime())->getOffset() / 60;
		$sign = $minutes < 0 ? -1 : 1;
		$minutes = abs($minutes);
		$hours = floor($minutes / 60);
		$minutes -= $hours * 60;

		return sprintf('%+d:%02d', $hours * $sign, $minutes);
	}
}
