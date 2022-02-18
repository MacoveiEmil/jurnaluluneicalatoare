<?php

/**
 * Ad Section
 *
 * @package Good_Looking_Blog
 */

if (is_active_sidebar('ad-home')) { ?>
    <section class="advertisment-section">
        <div class="container">
            <section id="advertisement" class="advertisment">
                <?php dynamic_sidebar('ad-home'); ?>
            </section>
        </div>
    </section>
<?php
}
