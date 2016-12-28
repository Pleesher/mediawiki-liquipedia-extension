<?php
return [
	'contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id) >= 1;
		},
		'category' => 'general'
	],
	'contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 50];
		},
		'category' => 'general'
	],
	'contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 2500];
		},
		'category' => 'general'
	],
	'contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id), 100000];
		},
		'category' => 'general'
	],

	'player_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']) >= 1;
		},
		'category' => 'players'
	],
	'player_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']), 50];
		},
		'category' => 'players'
	],
	'player_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']), 2500];
		},
		'category' => 'players'
	],
	'player_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players']), 100000];
		},
		'category' => 'players'
	],

	'team_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']) >= 1;
		},
		'category' => 'teams'
	],
	'team_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']), 50];
		},
		'category' => 'teams'
	],
	'team_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']), 2500];
		},
		'category' => 'teams'
	],
	'team_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams']), 100000];
		},
		'category' => 'teams'
	],

	'edit_streak_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 2];
		},
		'category' => 'general'
	],
	'edit_streak_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 7];
		},
		'category' => 'general'
	],
	'edit_streak_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 30];
		},
		'category' => 'general'
	],
	'edit_streak_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 365];
		},
		'category' => 'general'
	],

	'massive_edit' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxEditLength($user_id), 100000];
		},
		'category' => 'general',
		'professions' => ['historian']
	],
	'pizza_master' => [
		'checker' => function($goal, $user_id, array $context) {
			return true;
		},
		'category' => 'unconventional',
		'professions' => ['historian', 'reporter']
	],
	'necromancer' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id), 364];
		},
		'category' => 'unconventional'
	],
];
