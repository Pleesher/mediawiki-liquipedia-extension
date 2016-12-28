<?php
return [
	'contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id) >= 1;
		}
	],
	'contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 50];
		}
	],
	'contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 2500];
		}
	],
	'contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 100000];
		}
	],

	'player_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']) >= 1;
		}
	],
	'player_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']), 50];
		}
	],
	'player_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']), 2500];
		}
	],
	'player_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']), 100000];
		}
	],

	'team_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']) >= 1;
		}
	],
	'team_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']), 50];
		}
	],
	'team_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']), 2500];
		}
	],
	'team_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']), 100000];
		}
	],

	'edit_streak_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 2];
		}
	],
	'edit_streak_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 7];
		}
	],
	'edit_streak_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 30];
		}
	],
	'edit_streak_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 365];
		}
	],

	'massive_edit' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditLength($user_id), 100000];
		},
		'professions' => ['historian']
	],
	'pizza_master' => [
		'checker' => function($goal, $user_id, array $context) {
			return true;
		},
		'professions' => ['historian', 'reporter']
	],
	'necromancer' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id), 364];
		}
	],
];
