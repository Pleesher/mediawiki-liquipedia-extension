<?php
$_team_templates_page_title_regex = '^(Team2?(Short)?/|TeamBracket/|TeamPart/|TeamIcon/|TeamPage/)';
$_main_namespaces_filter        = 'p.page_namespace % 2 = 0 && p.page_namespace != :user_namespace';
$_main_namespaces_filter_params = [':user_namespace' => NS_USER];

return [
	'content_creator_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		}
	],
	'content_creator_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 10];
		}
	],
	'content_creator_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100];
		}
	],
	'content_creator_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 1000];
		}
	],

	'contributor_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		}
	],
	'contributor_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		}
	],
	'contributor_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		}
	],
	'contributor_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		}
	],

	'player_contributor_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		}
	],
	'player_contributor_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		}
	],
	'player_contributor_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		}
	],
	'player_contributor_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Players', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		}
	],

	'team_contributor_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		}
	],
	'team_contributor_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		}
	],
	'team_contributor_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		}
	],
	'team_contributor_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['category_title' => 'Teams', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		}
	],

	'transfer_contributor_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return $context['query_helper']->getUserEditCount(User::idFromName($user_name), ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]) >= 1;
		}
	],
	'transfer_contributor_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name),  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 50];
		}
	],
	'transfer_contributor_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name),  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 2500];
		}
	],
	'transfer_contributor_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name),  ['page_title_regex' => '([[:<:]]|_|^)[tT]ransfers?([[:>:]]|_|$)', '_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 100000];
		}
	],

	'template_contributor_bronze' => [
		'checker' => function($goal, $user_name, array $context) {
			return $context['query_helper']->getUserEditCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE]) >= 1;
		}
	],
	'template_contributor_silver' => [
		'checker' => function($goal, $user_name, array $context) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE]), 50];
		}
	],
	'template_contributor_gold' => [
		'checker' => function($goal, $user_name, array $context) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE]), 2500];
		}
	],
	'template_contributor_diamond' => [
		'checker' => function($goal, $user_name, array $context) {
			return [$context['query_helper']->getUserEditCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE]), 100000];
		}
	],

	'template_creator_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_team_templates_page_title_regex) {
			return $context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]) >= 1;
		}
	],
	'template_creator_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_team_templates_page_title_regex) {
			return [$context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]), 10];
		}
	],
	'template_creator_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_team_templates_page_title_regex) {
			return [$context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]), 100];
		}
	],
	'template_creator_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_team_templates_page_title_regex) {
			return [$context['query_helper']->getUserPageCreationCount(User::idFromName($user_name), ['namespace' => NS_TEMPLATE, 'page_title_negative_regex' => $_team_templates_page_title_regex]), 1000];
		}
	],

	'edit_streak_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak(User::idFromName($user_name)), 2];
		}
	],
	'edit_streak_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 7];
		}
	],
	'edit_streak_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 30];
		}
	],
	'edit_streak_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxEditStreak(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 365];
		}
	],

	'necromancer_bronze' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364];
		}
	],
	'necromancer_silver' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364 * 2];
		}
	],
	'necromancer_gold' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364 * 5];
		}
	],
	'necromancer_diamond' => [
		'checker' => function($goal, $user_name, array $context) use($_main_namespaces_filter, $_main_namespaces_filter_params) {
			return [$context['query_helper']->getUserMaxBumpDays(User::idFromName($user_name), ['_where' => $_main_namespaces_filter, '_where_params' => $_main_namespaces_filter_params]), 364 * 10];
		}
	],
];
