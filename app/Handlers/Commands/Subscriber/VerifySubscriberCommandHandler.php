<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Handlers\Commands\Subscriber;

use CachetHQ\Cachet\Commands\Subscriber\VerifySubscriberCommand;
use CachetHQ\Cachet\Events\Subscriber\SubscriberHasVerifiedEvent;
use CachetHQ\Cachet\Models\Subscriber;
use Carbon\Carbon;

class VerifySubscriberCommandHandler
{
    /**
     * Handle the subscribe customer command.
     *
     * @param \CachetHQ\Cachet\Commands\Subscriber\VerifySubscriberCommand $command
     *
     * @return void
     */
    public function handle(VerifySubscriberCommand $command)
    {
        $subscriber = $command->subscriber;

        $subscriber->verified_at = Carbon::now();
        $subscriber->save();

        event(new SubscriberHasVerifiedEvent($subscriber));
    }
}
