<?php
namespace Jscarton\MyMovies;

class Installer {

	public static $VERSION='1.0.0';


	private static $tables = [
		"my_movies" => [
			"sql" => "CREATE TABLE tablename (
				id INTEGER NOT NULL,
				title VARCHAR(256) NOT NULL,
				year VARCHAR(4) NOT NULL,
				runtime VARCHAR(5) NOT NULL,
				genres	VARCHAR(256) NOT NULL,
				director VARCHAR(128) NOT NULL,
				actors  VARCHAR(256) NOT NULL,
				plot  VARCHAR(512)NOT NULL,
				posterUrl varchar(512) NOT NULL,
				created_at DATETIME NOT NULL DEFAULT NOW(),
				created_by BIGINT(20) UNSIGNED DEFAULT NULL,
				updated_at DATETIME NOT NULL DEFAULT NOW(),
				updated_by BIGINT(20) UNSIGNED DEFAULT NULL,
				deleted_at DATETIME DEFAULT NULL,
				deleted_by BIGINT(20) UNSIGNED DEFAULT NULL,
				PRIMARY KEY  (id)
			) charset_collate;"
		],

	]; 
	public static function install() {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global $wpdb;
		// read seed data
		$movie_list = include dirname(plugin_dir_path( __FILE__ )) . '/data/movies.php';
		$charset_collate = $wpdb->get_charset_collate();		
		// create table
		foreach (self::$tables as $table_name => $table) {
			$formattedSQL = self::formatSQL($wpdb->prefix, $table_name,$charset_collate,$table['sql']);
			dbDelta( $formattedSQL );			
		}
		// insert seed data
		if (!empty( $movie_list)) {
			foreach($movie_list as $movie) {
				$movie['genres'] = json_encode($movie['genres']);
				$result = $wpdb->insert("{$wpdb->prefix}my_movies", $movie);
				if(!$result) {
					var_dump('insert failed',$wpdb->last_result, $wpdb->last_query); exit;
				}
			}
		}
		add_option( 'js_my_movies_db_version', self::$VERSION );
	}
	public static function uninstall() {
		global $wpdb;
		$wpdb->query( "DROP TABLE {$wpdb->prefix}my_movies;" );
		delete_option( 'js_my_movies_db_version');
	}

	private static function formatSQL($prefix,$tablename,$charset_collate,$sql) {
		return str_replace(['prefix', 'tablename', 'charset_collate'],[$prefix, $prefix.$tablename, $charset_collate],$sql);
	}
}
