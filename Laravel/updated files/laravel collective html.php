<!-- In Command Line  -->
composer require "laravelcollective/html"
<!-- Next, add your new provider to the providers array of config/app.php -->
Collective\Html\HtmlServiceProvider::class,
<!-- Finally, add two class aliases to the aliases array of config/app.php -->
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,
<!-- More Details -->
https://laravelcollective.com/docs/5.2/html
