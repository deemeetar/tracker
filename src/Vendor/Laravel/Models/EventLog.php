<?php

/**
 * Part of the Tracker package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    Tracker
 * @author     Antonio Carlos Ribeiro @ PragmaRX
 * @license    BSD License (3-clause)
 * @copyright  (c) 2013, PragmaRX
 * @link       http://pragmarx.com
 */

namespace PragmaRX\Tracker\Vendor\Laravel\Models;

class EventLog extends Base {

	protected $table = 'tracker_events_log';

	protected $fillable = array(
		'event_id',
		'class_id',
	    'log_id',
	);

	public function allInThePeriod($minutes, $result)
	{
		$query =
			$this
				->select(
					'tracker_events_log.id',
					'tracker_events_log.event_id',
					'tracker_events_log.log_id',
					'tracker_events_log.updated_at',
					'tracker_sessions.user_id',
					'tracker_log.method',
					'users.email',
					'tracker_events.name',
					'tracker_paths.path'
				)
				->from('tracker_events_log')
				->period($minutes, 'tracker_events_log')
				->join('tracker_events', 'tracker_events.id', '=', 'tracker_events_log.event_id')
				->join('tracker_log', 'tracker_log.id', '=', 'tracker_events_log.log_id')
				->join('tracker_sessions', 'tracker_sessions.id', '=', 'tracker_log.session_id')
				->join('users', 'users.id', '=', 'tracker_sessions.user_id')
				->join('tracker_paths', 'tracker_paths.id', '=', 'tracker_log.path_id')
				->orderBy('tracker_events_log.created_at', 'desc');

		if ($result)
		{
			return $query->get();
		}

		return $query;
	}

}
