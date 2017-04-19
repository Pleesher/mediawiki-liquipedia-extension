<?php
$_team_templates_page_title_regex = '^(Team2?(Short)?/|TeamBracket/|TeamPart/|TeamIcon/|TeamPage/)';
$_main_namespaces_filter        = 'p.page_namespace % 2 = 0 && p.page_namespace != :user_namespace';
$_main_namespaces_filter_params = [':user_namespace' => NS_USER];

return [
	'content_creator_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserPageCreationCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		},
		'category' => 'general'
	],
	'content_creator_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 10];
		},
		'category' => 'general'
	],
	'content_creator_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100];
		},
		'category' => 'general'
	],
	'content_creator_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 1000];
		},
		'category' => 'general'
	],

	'contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		},
		'category' => 'general'
	],
	'contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		},
		'category' => 'general'
	],
	'contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		},
		'category' => 'general'
	],
	'contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		},
		'category' => 'general'
	],

	'player_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		},
		'category' => 'players'
	],
	'player_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		},
		'category' => 'players'
	],
	'player_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		},
		'category' => 'players'
	],
	'player_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		},
		'category' => 'players'
	],

	'team_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		},
		'category' => 'teams'
	],
	'team_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		},
		'category' => 'teams'
	],
	'team_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		},
		'category' => 'teams'
	],
	'team_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id, ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		},
		'category' => 'teams'
	],

	'transfer_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount($user_id, ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		},
		'category' => 'transfers'
	],
	'transfer_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id,  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		},
		'category' => 'transfers'
	],
	'transfer_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id,  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		},
		'category' => 'transfers'
	],
	'transfer_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount($user_id,  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		},
		'category' => 'transfers'
	],

	'template_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id, ['namespace' => NS_TEMPLATE]) >= 1;
		},
		'category' => 'improving_liquipedia'
	],
	'template_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['namespace' => NS_TEMPLATE]), 50];
		},
		'category' => 'improving_liquipedia'
	],
	'template_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['namespace' => NS_TEMPLATE]), 2500];
		},
		'category' => 'improving_liquipedia'
	],
	'template_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id, ['namespace' => NS_TEMPLATE]), 100000];
		},
		'category' => 'improving_liquipedia'
	],

	'template_creator_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_team_templates_page_title_regex) {
			return $context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]) >= 1;
		},
		'category' => 'improving_liquipedia'
	],
	'template_creator_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_team_templates_page_title_regex) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]), 10];
		},
		'category' => 'improving_liquipedia'
	],
	'template_creator_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_team_templates_page_title_regex) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]), 100];
		},
		'category' => 'improving_liquipedia'
	],
	'template_creator_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_team_templates_page_title_regex) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]), 1000];
		},
		'category' => 'improving_liquipedia'
	],

	'edit_streak_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id), 2];
		},
		'category' => 'general'
	],
	'edit_streak_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 7];
		},
		'category' => 'general'
	],
	'edit_streak_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 30];
		},
		'category' => 'general'
	],
	'edit_streak_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 365];
		},
		'category' => 'general'
	],

	'necromancer_bronze' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364];
		},
		'category' => 'unconventional'
	],
	'necromancer_silver' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364 * 2];
		},
		'category' => 'unconventional'
	],
	'necromancer_gold' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364 * 5];
		},
		'category' => 'unconventional'
	],
	'necromancer_diamond' => [
		'checker' => function($goal, $user_id, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id, ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364 * 10];
		},
		'category' => 'unconventional'
	],
];
