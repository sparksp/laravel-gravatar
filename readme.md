# Gravatar for Laravel

A simple bundle to provide [Gravatar](http://gravatar.com/) functions in Laravel.

## Installation

Drop the **gravatar** bundle into your **/bundles** directory and add gravatar to **/bundles/bundles.php**.

## Configuration

Default size, rating and default image can be configured in **config/default.php**.  Full documentation is included in the config file.

## Usage

### Get a Gravatar URL

    Gravatar\Gravatar::url('me@phills.me.uk', 120);

### Get the HTML for a Gravatar image

    Gravatar\Gravatar::image('me@phills.me.uk', null, 'Phill Sparks');
