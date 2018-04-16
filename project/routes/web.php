<?php

Route::any('{all}', 'SiteController')->where(['all' => '(?!api).*']);
