---
layout: default
title: Gravitas Bundle
---

<header class="jumbotron subhead" id="overview">
	<h1>Gravitas Bundle <small>by Phill Sparks</small></h1>
    <p class="lead">A <a href="http://gravatar.com/">Gravatar</a> bundle for <a href="http://laravel.com/">Laravel</a>.</p>
</header>

Install via the Artisan CLI:

    php artisan bundle:install gravitas

Get a Gravatar URL

    Gravitas\API::url('me@phills.me.uk', 120);

Get the HTML for a Gravatar image

    Gravitas\API::image('me@phills.me.uk', null, 'Phill Sparks');

You can configure the size, rating and default image in **config/default.php**.  Full documentation is included in the config file.
