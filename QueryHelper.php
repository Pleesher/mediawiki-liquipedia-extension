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
			$joins[]  = 'categorylinks cl ON cl.cl_type = \'page\' AND cl.cl_from = r.rev_page';
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
			FROM revision r
			JOIN text t ON r.rev_text_id = t.old_id
			JOIN revision pr ON r.rev_parent_id = pr.rev_id
			JOIN text pt ON pr.rev_text_id = pt.old_id';
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

	public function getMaxUserEditLength($user_id, array $filters = [])
	{
		$joins  = [];
		$wheres = [];
		$params = [];

		if (isset($filters['category_title']))
		{
			$joins[]  = 'categorylinks cl ON cl.cl_type = \'page\' AND cl.cl_from = r.rev_page';
			$wheres[] = 'cl.cl_to = :category_title';
			$params[':category_title'] = $filters['category_title'];
		}

		$sql = '
			SELECT MAX(LENGTH(t.old_text) - LENGTH(pt.old_text)) AS max_edit_length
			FROM revision r
			JOIN text t ON r.rev_text_id = t.old_id
			JOIN revision pr ON r.rev_parent_id = pr.rev_id
			JOIN text pt ON pr.rev_text_id = pt.old_id';
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

		return $query->fetchColumn(0);
	}
}
