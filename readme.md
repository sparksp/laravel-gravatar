# Gravitas Bundle, by Phill Sparks

A Laravel [Gravatar](http://gravatar.com/) bundle, installable via the Artisan CLI:

    php artisan bundle:install gravitas

Get a Gravatar URL

    Gravitas\API::url('me@phills.me.uk', 120);

Get the HTML for a Gravatar image

    Gravitas\API::image('me@phills.me.uk', null, 'Phill Sparks');

You can configure the size, rating and default image in **config/default.php**.  Full documentation is included in the config file.
