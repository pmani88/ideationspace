/* User and session tables */

CREATE TABLE users (
	id INTEGER PRIMARY KEY,
	email VARCHAR(100) UNIQUE,
	firstname VARCHAR(50),
	lastname VARCHAR(50),
	organization VARCHAR(100),
	password VARCHAR(50),
	admin BOOLEAN DEFAULT 0,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);

CREATE TABLE sessions(
	id INTEGER PRIMARY KEY, 	
	user_id INTEGER NOT NULL,
	name TEXT NOT NULL,
	description text,
	created DATETIME DEFAULT NULL
);

CREATE TABLE log_entries (
	id INTEGER PRIMARY KEY,
	session_id INTEGER NOT NULL,
	entry TEXT,
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);


/* Previous Ideation tool tables */

CREATE TABLE ideation_blocks(
	id INTEGER PRIMARY KEY,
	name TEXT,
	problem_novelty TEXT,
	problem_complexity TEXT,
	problem_uncertainty TEXT,
	process_time TEXT,
	outcome_quantity TEXT,
	outcome_quality TEXT,
	outcome_novelty TEXT,
	outcome_variety TEXT
);

CREATE TABLE mini_strategies(
	id INTEGER PRIMARY KEY,
	name TEXT
);

CREATE TABLE ideation_blocks_mini_strategies(
	id INTEGER PRIMARY KEY,
	ideation_block_id INTEGER,
	mini_strategy_id INTEGER
);

CREATE TABLE ideation_methods(
	id INTEGER PRIMARY KEY,
	name TEXT
);

CREATE TABLE ideation_methods_mini_strategies(
	id INTEGER PRIMARY KEY,
	mini_strategy_id INTEGER,
	ideation_method_id INTEGER
);

CREATE TABLE physical_effects(
	id INTEGER PRIMARY KEY,
	name TEXT,
	description TEXT,
	medium TEXT,
	field TEXT
);

CREATE TABLE equations(
	id INTEGER PRIMARY KEY,
	name TEXT
);

CREATE TABLE equations_physical_effects(
	id INTEGER PRIMARY KEY,
	physical_effect_id INTEGER,
	equation_id INTEGER
);

CREATE TABLE physical_parameters(
	id INTEGER PRIMARY KEY,
	name TEXT,
	field TEXT
);

CREATE TABLE equations_physical_parameters(
	id INTEGER PRIMARY KEY,
	equation_id INTEGER,
	physical_parameter_id INTEGER
);

CREATE TABLE flow_variables(
	id INTEGER PRIMARY KEY,
	name TEXT,
	category TEXT
);

CREATE TABLE flow_variables_physical_effects(
	id INTEGER PRIMARY KEY,
	flow_variable_id INTEGER,
	physical_effect_id INTEGER
);

CREATE TABLE funcs(
	id INTEGER PRIMARY KEY,
	parent_func_id INTEGER DEFAULT NULL,
	name TEXT
);

CREATE TABLE principles(
	id INTEGER PRIMARY KEY,
	name TEXT
);

CREATE TABLE triz_parameters(
	id INTEGER PRIMARY KEY,
	name TEXT,
	category TEXT
);

CREATE TABLE physical_parameters_improving_triz_parameters(
	id INTEGER PRIMARY KEY,
	physical_parameter_id INTEGER,
	triz_parameter_id INTEGER
);

CREATE TABLE physical_parameters_worsening_triz_parameters(
	id INTEGER PRIMARY KEY,
	physical_parameter_id INTEGER,
	triz_parameter_id INTEGER
);

CREATE TABLE function_trizs(
	id INTEGER PRIMARY KEY,
	func_id INTEGER,
	flow_category TEXT,
	principle_id INTEGER
);

CREATE TABLE bio_trizs(
	id INTEGER PRIMARY KEY,
	improving_category TEXT,
	worsening_category TEXT,
	principle_id INTEGER
);

CREATE TABLE triz_matrices(
	id INTEGER PRIMARY KEY,
	principle_id INTEGER,
	improving_triz_parameter_id INTEGER,
	worsening_triz_parameter_id INTEGER
);

CREATE TABLE physical_variables(
	id INTEGER PRIMARY KEY,
	physical_parameter_id INTEGER
);

CREATE TABLE wp_components(
	id INTEGER PRIMARY KEY,
	name TEXT
);

CREATE TABLE working_principles(
	id INTEGER PRIMARY KEY,
	name TEXT,
	description TEXT,
	type TEXT,
	bioexample_url TEXT,
	picture TEXT,
	material TEXT,
	functions TEXT
);

CREATE TABLE physical_variables_working_principles(
	id INTEGER PRIMARY KEY,
	working_principle_id INTEGER,
	physical_variable_id INTEGER
);

CREATE TABLE working_principles_wp_components(
	id INTEGER PRIMARY KEY,
	wp_component_id INTEGER,
	working_principle_id INTEGER
);

CREATE TABLE physical_effects_working_principles(
	id INTEGER PRIMARY KEY,
	physical_effect_id INTEGER,
	working_principle_id INTEGER
);

CREATE TABLE high_functions_working_principles(
	id INTEGER PRIMARY KEY,
	func_id INTEGER,
	flow_variable_id INTEGER,
	working_principle_id INTEGER
);

CREATE TABLE low_functions_working_principles(
	id INTEGER PRIMARY KEY,
	flow_variable_id INTEGER,
	working_principle_id INTEGER
);

/* Ying DB tables */

CREATE TABLE morph_chart_problems(
	id INTEGER PRIMARY KEY,
	session_id INTEGER NOT NULL,
	morph_chart_problem_id INTEGER DEFAULT NULL,
	name TEXT NOT NULL
);

CREATE TABLE morph_chart_solutions(
	id INTEGER PRIMARY KEY,
	session_id INTEGER NOT NULL,
	morph_chart_problem_id INTEGER NOT NULL,
	name TEXT NOT NULL,
	text_document TEXT,
	graphic_document TEXT
);

CREATE TABLE morph_chart_solutions_solution_sets(
	id INTEGER PRIMARY KEY,
	morph_chart_solution_id INTEGER,
	solution_set_id INTEGER
);

CREATE TABLE solution_sets(
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL,
	session_id INTEGER NOT NULL
);

CREATE TABLE morph_chart_images(
	id INTEGER PRIMARY KEY,
	morph_chart_solution_id INTEGER,
	file_name TEXT
);

CREATE TABLE manipulative_verbs(
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL,
	number_of_images INTEGER NOT NULL
);

CREATE TABLE verbs(
	id INTEGER PRIMARY KEY,
	name TEXT
);

CREATE TABLE conjunctions(
	id INTEGER PRIMARY KEY,
	name TEXT,
	number_of_images INTEGER
);

CREATE TABLE pronouns(
	id INTEGER PRIMARY KEY,
	name TEXT
);

/* OSU DB tables */

CREATE TABLE artifacts (
    id integer NOT NULL,
    name TEXT NOT NULL,
    parent_artifact integer,
    comp_basis_name integer,
    serial_id_number TEXT,
    assembly INTEGER DEFAULT 0 NOT NULL,
    description TEXT,
    quantity integer DEFAULT 1 NOT NULL,
    system integer NOT NULL,
    manufacturer TEXT,
    trademark TEXT,
    artifact_release_date date,
    entry_date date NOT NULL,
    modification_date date,
    creator_info integer,
    part_family TEXT
);

CREATE TABLE artifact_images (
    id integer NOT NULL,
    artifact_id integer NOT NULL,
    image_file_name TEXT NOT NULL
);

CREATE TABLE comp_basis_types (
    id integer NOT NULL,
    component TEXT NOT NULL,
    tier integer NOT NULL,
    parent_component integer,
    definition TEXT
);

CREATE TABLE failures (
    id integer NOT NULL,
    describes_artifact integer NOT NULL,
    failure integer NOT NULL,
    severity real,
    potential INTEGER NOT NULL,
    occurrences integer,
    rating_type integer,
    sample_size integer,
    rate real
);

CREATE TABLE failure_types (
    id INTEGER NOT NULL,
    failure TEXT NOT NULL,
    tier INTEGER,
    parent_failure INTEGER,
    definition TEXT
);

CREATE TABLE flow_types (
    id integer NOT NULL,
    flow TEXT NOT NULL,
    tier integer NOT NULL,
    child_of_flow integer,
    definition TEXT
);

CREATE TABLE flows (
    id integer NOT NULL,
    describes_function integer NOT NULL,
    input_artifact integer NOT NULL,
    input_flow integer NOT NULL,
    output_flow integer NOT NULL,
    output_artifact integer NOT NULL,
    active INTEGER DEFAULT 1 NOT NULL
);

CREATE TABLE osu_functions (
    id integer NOT NULL,
    describes_artifact integer NOT NULL,
    subfunction_type integer NOT NULL,
    supporting integer DEFAULT 0 NOT NULL
);

CREATE TABLE subfunction_types (
    id INTEGER NOT NULL,
    subfunction TEXT NOT NULL,
    tier INTEGER NOT NULL,
    parent_subfunction INTEGER,
    definition TEXT
);

CREATE TABLE manufacturing_process_types (
    id integer NOT NULL,
    manufac_type TEXT NOT NULL,
    description TEXT
);

CREATE TABLE manufacturing_processes (
    id integer NOT NULL,
    describes_artifact integer NOT NULL,
    manufac_process_type integer
);

/* survey table */
CREATE TABLE satisfaction_surveys (
	id integer PRIMARY KEY,
	ideation_block_id integer NOT NULL,
	ideation_method_id integer NOT NULL,
	user_id integer NOT NULL,
	functional_requirements_satisfied TEXT,
	non_functional_requirements_satisfied TEXT,
	ergonomic_requirements_satisfied TEXT,
	time_spent INTEGER,
	recommendation TEXT,
	richness TEXT,
	state_of_mind TEXT
);

/* function CAD tables -- entities and links */

CREATE TABLE function_cad_entities (
	id INTEGER PRIMARY KEY,
	name TEXT,
	flow TEXT,
	x INTEGER DEFAULT 10,
	y INTEGER DEFAULT 10,
	session_id INTEGER
);

CREATE TABLE function_cad_links (
	id INTEGER PRIMARY KEY,
	from_function_cad_entity_id INTEGER NOT NULL,
	to_function_cad_entity_id INTEGER NOT NULL,
	type INTEGER DEFAULT 0,
	session_id INTEGER
);

/* Function analysis */

CREATE TABLE formulas (
	id integer PRIMARY KEY,
	name TEXT NOT NULL,
	equation TEXT NOT NULL
); 
