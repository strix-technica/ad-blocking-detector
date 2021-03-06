<?php
/**
 * This file containst the 'ABD_Log' class definition which provides tools for logging
 * actions during the current SESSION.
 */

if ( !class_exists( 'ABD_Log' ) ) {
	class ABD_Log {
		protected static $our_option_name = 'abd_event_log';

		public static function error( $msg, $indented = false ) {
			$enable_errors = ABD_Database::get_specific_setting( 'enable_error_logging' );

			if( $enable_errors != 'no' ) {
				self::generic_log_entry( 'ERROR', $msg, $indented );
			}
		}

		public static function info( $msg, $indented = false ) {
			$enable_info = ABD_Database::get_specific_setting( 'enable_info_logging' );

			if( $enable_info != 'no' ) {
				self::generic_log_entry( 'INFO', $msg, $indented );
			}
		}

		public static function debug( $msg, $indented = false ) {
			$enable_debug = ABD_Database::get_specific_setting( 'enable_debug_logging' );

			if( $enable_debug != 'no' ) {
				self::generic_log_entry( 'DEBUG', $msg, $indented );
			}
		}

		public static function perf( $msg, $indented = false ) {
			$enable_perf_logging = ABD_Database::get_specific_setting( 'enable_perf_logging' );

			if( $enable_perf_logging != 'no' ) {
				self::generic_log_entry( 'PERF', $msg, $indented );
			}
		}



		public static function get_all_log_entries() {
			$entries = get_site_option( self::get_option_name(), array() );

			if( !is_array( $entries ) ) {
				return array();
			}

			return $entries;
		}

		public static function get_last_log_entry() {
			$es = self::get_all_log_entries();

			return end( $es );
		}

		public static function get_readable_log( $num_entries = 0, $indentation = '    >>   ', $line_endings = '&#13;&#10;&#13;&#10;' ) {
			$enabled = ABD_Database::get_specific_setting( 'enable_logging' );

			if( $enabled === 'no' ) {
				return ABD_L::__( '* Logging has been disabled in Advanced Settings.' );
			}

			$readable = '';
			$es = self::get_all_log_entries();

			//	Get indices interval
			if( $num_entries > 0 ) {
				$start = count( $es ) - $num_entries;

				if( $start < 0 ) {	//	No negative indices!
					$start = 0;
				}
			}
			else {
				$start = 0;
			}

			$end = count( $es ) - 1;	//	Last index


			//	Loop through those indices of the log
			for( $i = $end; $i >= $start; $i-- ) {
				if( !array_key_exists( $i, $es ) ) {
					//	Hmm... This doesn't exist for some reason
					continue;
				}

				//	Okay, append readable log to string
				$type = $es[$i]['type'];
				$msg = $es[$i]['message'];
				$time = $es[$i]['time'];

				if( !$es[$i]['indented'] ) {
					$indentation = '';
				}

				//	Pad type with spaces for uniformity
				for( $j=strlen( $type ); $j <= 8; $j++ ) {
					$type .= ' ';
				}
				
				$readable .= $indentation . $type . ' :: ' . $time . ' ::   ' . $msg . /*' ::  ' . $loc .*/ $line_endings;
			}

			if( empty( $readable ) ) {
				$readable = ABD_L::__( '* No log entries at this time.' );
			}

			return $readable;
		}

		public static function clear_log( $type='all' ) {
			return delete_site_option( self::get_option_name() );
		}


		protected static function generic_log_entry( $type, $msg, $indented = false ) {
			$enable = ABD_Database::get_specific_setting( 'enable_logging' );

			if( $enable != 'no' ) {
				$e = self::get_all_log_entries();

				$e[] = array(
					'type' => $type,
					'message' => $msg,
					'time' => date( 'm/d/y @ H:i:s (P' ) . ' GMT)',
					'indented' => $indented
				);			

				$e = self::prune_log( $e );

				update_site_option( self::get_option_name(), $e );
			}
		}

		protected static function prune_log( $value = null, $max_entries = 500 ) {
			if( $value == null ) {
				$value = self::get_all_log_entries();
			}


			if( count( $value ) > $max_entries ) {
				$value = array_slice( $value, -1*$max_entries );
			}

			return $value;
		}



		protected static function get_option_name() {
			return self::$our_option_name;
		}


		/**
		 * Given $time in microseconds, calculate time difference from now in milliseconds.
		 *
		 * @param    int   $start_time   A time measured in microseconds. e.g. from PHP's microtime() function
		 *
		 * @return   float           Difference between now and $time in milliseconds rounded to 3 decimal places
		 */
		public static function time_diff( $start_time ) {
			return round( (microtime(true) - $start_time) * 1000, 3 );
		}

		/**
		 * Given $start_mem_usage in bytes, calculate difference from current memory usage.
		 *
		 * @param    int    $start_mem_usage   Amount of memory used in bytes.
		 * @param    boolean   $readable          Whether to return bytes or a readable string. TRUE = readable string
		 * @param    string    $unit_length       Whether to use short (e.g. MB) or long (e.g. megabyte) format for units in readable string. Valid options are 'short' and 'long'
		 *
		 * @return   mixed                       Either an integer number of bytes or a human readable string representing that number of bytes.
		 */
		public static function mem_diff( $start_mem_usage, $readable = true, $unit_length = 'short' ) {
			$unit_map = array(
				'bytes'     => array( 'short' => 'B' , 'long' => ' bytes' ),
				'kilobytes' => array( 'short' => 'KB', 'long' => ' kilobytes' ),
				'megabytes' => array( 'short' => 'MB', 'long' => ' megabytes' ),
				'gigabytes' => array( 'short' => 'GB', 'long' => ' gigabytes' )
			);


			$end_mem = memory_get_usage( true );

			$diff = $end_mem - $start_mem_usage;

			if( !$readable ) {
				return $diff;
			}


			if( $diff < 1024 ) {
				//	Bytes
				return $diff . $unit_map['bytes'][$unit_length];
			}
			else if ( $diff < 1048576 ) {
				//	Kilobytes
				return round( $diff/1024, 3 ) . $unit_map['kilobytes'][$unit_length];
			}
			else if ( $diff < 1073741824 ) {
				//	Megabytes
				return round( $diff/1048576, 3 ) . $unit_map['megabytes'][$unit_length];
			}
			else {
				//	Gigabytes
				return round( $diff/1073741824, 3 ) . $unit_map['gigabytes'][$unit_length];
			}
		}

		/**
		 * Outputs a report of function performance to log.
		 *
		 * @param    string $func_name    The function (e.g. my_func()) or class::function (e.g. ABD_Database::get_shortcode()) this performance pertains to.
		 * @param    int    $start_time   The start time of the function in microseconds (get this using microtime())
		 * @param    int    $start_mem    The start memory usage in bytes (get this using memory_get_usage())
		 * @param	bool 	$sub_entry	Signifies whether this is a sub entry for performance log (will get indented)
		 * @param float $time_alert_threshold The maximum amount of time in milliseconds before this function is starred as abnormal.
		 * @param int $mem_alert_threshold The maximum amount of memory used before this function is starred as abnormal.
		 */
		public static function perf_summary( $func_name, $start_time, $start_mem, $sub_entry = false, $time_alert_threshold = 100, $mem_alert_threshold = 500000 ) {
			//	Check for settings thresholds and filtration
			$settings = ABD_Database::get_settings();
			$time_limit = ABD_Database::get_specific_setting( 'perf_logging_time_limit' );
			$mem_limit = ABD_Database::get_specific_setting( 'perf_logging_mem_limit' );
			$only_above_threshold = ABD_Database::get_specific_setting( 'perf_logging_only_above_limits' );

			if( !is_null( $time_limit ) ) {
				$time_alert_threshold = $time_limit;
			}
			if( !is_null( $mem_limit ) ) {
				$mem_alert_threshold = $mem_limit;
			}
			if( $only_above_threshold != 'no' ) {
				$only_above_threshold = true;
			}
			else {
				$only_above_threshold = false;
			}


			$bytes = self::mem_diff( $start_mem, false );
			$ms = self::time_diff( $start_time );
			$above_threshold = false;

			$suffix = '';
			if( $ms > $time_alert_threshold ) {
				$above_threshold = true;
				$time_times_over = round( $ms / $time_alert_threshold );				
				$suffix .= ' T';
				for( ; $time_times_over > 0; $time_times_over-- ) {
					$suffix .= '!';
				}
				$suffix .= ' ';
			}
			if( $bytes > $mem_alert_threshold ) {
				$above_threshold = true;
				$mem_times_over = round( $bytes / $mem_alert_threshold );				
				$suffix .= ' M';
				for( ; $mem_times_over > 0; $mem_times_over-- ) {
					$suffix .= '!';
				}
				$suffix .= ' ';
			}
			

			if( !empty( $suffix ) ) {
				$suffix = ' #####' . $suffix . '#####';
			}

			if( !$only_above_threshold || $above_threshold ) {
				self::perf( $func_name . ' -- Exec Time = ' . self::time_diff( $start_time ) . 'ms, Mem Usage = ' . self::mem_diff( $start_mem ) . $suffix, $sub_entry );
			}
		}
	}	//	end class
}	//	end if ( !class_exists( ...