<?php
return [
	'massive_edit' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getMaxUserEditLength($user_id), 100000];
		},
		'professions' => ['historian']
	],
	'pizza_master' => [
		'checker' => function($goal, $user_id, array $context) {
			return true;
		},
		'professions' => ['historian', 'reporter']
	],
	'madman' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 20000];
		},
		'professions' => ['historian']
	],
	'first_edit' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id) > 0;
		}
	],
	'contributor' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 10];
		}
	],
	'necromancer' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getMaxBumpDays($user_id), 364];
		}
	],
	'beginner_biographer' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']), 10];
		}
	]
];
