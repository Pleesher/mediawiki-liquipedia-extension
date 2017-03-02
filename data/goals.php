<?php
$_team_templates_page_title_regex = '^(Team2?(Short)?/|TeamBracket/|TeamPart/|TeamIcon/|TeamPage/)';

return [
	'content_creator_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_MAIN]) >= 1;
		},
		'category' => 'general'
	],
	'content_creator_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_MAIN]), 10];
		},
		'category' => 'general'
	],
	'content_creator_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_MAIN]), 100];
		},
		'category' => 'general'
	],
	'content_creator_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserPageCreationCount($user_id, ['namespace' => NS_MAIN]), 1000];
		},
		'category' => 'general'
	],

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

	'transfer_contributor_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return $context['query_helper']->getUserEditCount($user_id, ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)']) >= 1;
		},
		'category' => 'transfers'
	],
	'transfer_contributor_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id,  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)']), 50];
		},
		'category' => 'transfers'
	],
	'transfer_contributor_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id,  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)']), 2500];
		},
		'category' => 'transfers'
	],
	'transfer_contributor_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserEditCount($user_id,  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)']), 100000];
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

	'necromancer_bronze' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id), 364];
		},
		'category' => 'unconventional'
	],
	'necromancer_silver' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id), 364 * 2];
		},
		'category' => 'unconventional'
	],
	'necromancer_gold' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id), 364 * 5];
		},
		'category' => 'unconventional'
	],
	'necromancer_diamond' => [
		'checker' => function($goal, $user_id, array $context) {
			return [$context['query_helper']->getUserMaxBumpDays($user_id), 364 * 10];
		},
		'category' => 'unconventional'
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
];
